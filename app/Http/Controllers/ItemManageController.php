<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Acces;
use App\Supply;
use App\Item;
use App\Transaction;
use App\Supply_system;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ItemManageController extends Controller
{
    // Show View Product
    public function viewItem()
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)->first();

        $items = Item::all()->sortBy('nama_bahan');
        $supply_system = Supply_system::first();

        return view('manage_item.item', compact('items', 'supply_system'));
    }

    // Show View New Product
    public function viewNewItem()
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)->first();
        $supply_system = Supply_system::first();

        return view('manage_item.new_item', compact('supply_system'));
    }

    // Create New Product
    public function createItem(Request $req)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)->first();
        $check_item = Item::where('kode_bahan', $req->kode_bahan)->count();
        $supply_system = Supply_system::first();
        $randomString = mt_rand();

        if ($check_item == 0) {
            $items = new Item();
            // $items->kode_bahan = mt_rand(1, 1000000);
            $items->kode_bahan = random_int(1, 1000000);
            $items->nama_bahan = $req->nama_bahan;
            $items->warna = $req->warna;
            if ($req->ukuran != '') {
                $items->ukuran = $req->ukuran . ' ' . $req->ukuran_bahan;
            }
            if ($supply_system->status == true) {
                $items->stok = $req->stok;
            } else {
                $items->stok = 1;
            }
            $items->harga = $req->harga;
            $items->save();

            Session::flash('create_success', 'Bahan baru berhasil ditambahkan');

            return redirect('/item');
        } else {
            Session::flash('create_failed', 'Kode bahan telah digunakan');

            return back();
        }
    }

    // Import New Product
    public function importProduct(Request $req)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)->first();
        if ($check_access->kelola_barang == 1) {
            try {
                $file = $req->file('excel_file');
                $nama_file = rand() . $file->getClientOriginalName();
                $file->move('excel_file', $nama_file);
                Excel::import(
                    new ProductImport(),
                    public_path('/excel_file/' . $nama_file)
                );

                Session::flash(
                    'import_success',
                    'Data barang berhasil diimport'
                );
            } catch (\Exception $ex) {
                Session::flash(
                    'import_failed',
                    'Cek kembali terdapat data kosong atau kode barang yang telah tersedia'
                );

                return back();
            }

            return redirect('/product');
        } else {
            return back();
        }
    }

    // Edit Product
    public function editItem($id)
    {
        $id_account = Auth::id();

        $items = Item::find($id);

        return response()->json(['items' => $items]);
    }

    // Update Product
    public function updateItem(Request $req)
    {
        $id_account = Auth::id();
        $check_product = Item::where('kode_bahan', $req->kode_bahan)->count();
        $item_data = Item::find($req->id);
        if ($check_product == 0 || $item_data->kode_bahan == $req->kode_bahan) {
            $items = Item::find($req->id);
            $kode_bahan = $items->kode_bahan;
            $items->kode_bahan = $req->kode_bahan;

            $items->nama_bahan = $req->nama_bahan;
            $items->warna = $req->warna;
            $items->ukuran = $req->ukuran . ' ' . $req->ukuran_bahan;

            $items->stok = $req->stok;
            $items->harga = $req->harga;
            if ($req->stok <= 0) {
                $items->keterangan = 'Habis';
            } else {
                $items->keterangan = 'Tersedia';
            }
            $items->save();

            Supply::where('kode_barang', $kode_bahan)->update([
                'kode_barang' => $req->kode_barang,
            ]);
            Transaction::where('kode_barang', $kode_bahan)->update([
                'kode_barang' => $req->kode_barang,
            ]);

            Session::flash('update_success', 'Data bahan berhasil diubah');

            return redirect('/item');
        } else {
            Session::flash('update_failed', 'Kode barang telah digunakan');

            return back();
        }
    }

    // Delete Product
    public function deleteItem($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)->first();

        Item::destroy($id);

        Session::flash('delete_success', 'Barang berhasil dihapus');

        return back();
    }
}