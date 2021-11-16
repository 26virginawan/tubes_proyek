@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/manage_product/product/style.css') }}">
@endsection
@section('content')
<div class="row page-title-header">
    <div class="col-12">
        <div class="page-header d-flex justify-content-between align-items-center">
            <h4 class="page-title">Data Bahan</h4>
            <div class="d-flex justify-content-start">
                <div class="dropdown">
                    <button class="btn btn-icons btn-inverse-primary btn-filter shadow-sm" type="button"
                        id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-filter-variant"></i>
                    </button>
                </div>
                <div class="dropdown dropdown-search">
                    <button class="btn btn-icons btn-inverse-primary btn-filter shadow-sm ml-2" type="button"
                        id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                    <div class="dropdown-menu search-dropdown" aria-labelledby="dropdownMenuIconButton1">
                        <div class="row">
                            <div class="col-11">
                                <input type="text" class="form-control" name="search" placeholder="Cari bahan">
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('/item/new') }}" class="btn btn-icons btn-inverse-primary btn-new ml-2">
                    <i class="mdi mdi-plus"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row modal-group">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('/item/update') }}" method="post" name="update_form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Bahan</h5>
                        <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="edit-modal-body">
                        @csrf
                        <div class="row" hidden="">
                            <div class="col-12">
                                <input type="text" name="id">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Kode
                                Bahan</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" class="form-control" name="kode_bahan" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Nama
                                Bahan</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" class="form-control" name="nama_bahan">
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 offset-lg-3 offset-md-3 error-notice"
                                id="nama_barang_error"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Warna</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="input-group-append">
                                    <select class="form-control" name="warna">
                                        <option value="Silver">Silver</option>
                                        <option value="Coklat">Coklat</option>
                                        <option value="Putih">Putih</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Ukuran</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="input-group">
                                    <input type="text" class="form-control number-input input-notzero" name="ukuran">
                                    <div class="input-group-append">
                                        <select class="form-control" name="ukuran_bahan">
                                            <option value="m">Meter</option>
                                            <option value="cm">Centimeter</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" @if($supply_system->status == false) hidden="" @endif>
                            <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Stok
                                Bahan</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" class="form-control number-input" name="stok">
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 offset-lg-3 offset-md-3 error-notice"
                                id="stok_error"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Harga
                                Bahan</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <input type="text" class="form-control number-input input-notzero" name="harga">
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 offset-lg-3 offset-md-3 error-notice"
                                id="harga_error"></div>
                        </div>
                    </div>
                    <div class="modal-body" id="scan-modal-body" hidden="">
                        <div class="row">
                            <div class="col-12 text-center" id="area-scan">
                            </div>
                            <div class="col-12 barcode-result" hidden="">
                                <h5 class="font-weight-bold">Hasil</h5>
                                <div class="form-border">
                                    <p class="barcode-result-text"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="edit-modal-footer">
                        <button type="submit" class="btn btn-update"><i class="mdi mdi-content-save"></i>
                            Simpan</button>
                    </div>
                    <div class="modal-footer" id="scan-modal-footer" hidden="">
                        <button type="button"
                            class="btn btn-primary btn-sm font-weight-bold rounded-0 btn-continue">Lanjutkan</button>
                        <button type="button"
                            class="btn btn-outline-secondary btn-sm font-weight-bold rounded-0 btn-repeat">Ulangi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card card-noborder b-radius">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>Kode bahan</th>
                                    <th>Nama bahan</th>
                                    <th>Warna</th>
                                    <th>Ukuran</th>
                                    @if($supply_system->status == true)
                                    <th>Stok</th>
                                    @endif
                                    <th>Harga</th>
                                    <th>Keterangan</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $items)
                                <tr>
                                    <td>{{ $items->kode_bahan }}</td>
                                    <td>{{ $items->nama_bahan }}</td>
                                    <td>{{$items->warna}}</td>
                                    <td>{{ $items->ukuran }}</td>
                                    <td>{{ $items->stok }}</td>
                                    <td><span class="ammount-box bg-green"><i class="mdi mdi-coin"></i></span>Rp.
                                        {{ number_format($items->harga,2,',','.') }}</td>
                                    @if($supply_system->status == true)
                                    <td>
                                        @if($items->keterangan == 'Tersedia')
                                        <span class="btn tersedia-span">{{ $items->keterangan }}</span>
                                        @else
                                        <span class="btn habis-span">{{ $items->keterangan }}</span>
                                        @endif
                                    </td>
                                    @endif
                                    <td>
                                        <button type="button" class="btn btn-edit btn-icons btn-rounded btn-secondary"
                                            data-toggle="modal" data-target="#editModal" data-edit="{{ $items->id }}">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button type="button"
                                            class="btn btn-icons btn-rounded btn-secondary ml-1 btn-delete"
                                            data-delete="{{ $items->id }}">
                                            <i class="mdi mdi-close"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('plugins/js/quagga.min.js') }}"></script>
<script src="{{ asset('js/manage_product/product/script.js') }}"></script>
<script type="text/javascript">
@if($message = Session::get('create_success'))
swal(
    "Berhasil!",
    "{{ $message }}",
    "success"
);
@endif

@if($message = Session::get('update_success'))
swal(
    "Berhasil!",
    "{{ $message }}",
    "success"
);
@endif

@if($message = Session::get('delete_success'))
swal(
    "Berhasil!",
    "{{ $message }}",
    "success"
);
@endif

@if($message = Session::get('import_success'))
swal(
    "Berhasil!",
    "{{ $message }}",
    "success"
);
@endif

@if($message = Session::get('update_failed'))
swal(
    "",
    "{{ $message }}",
    "error"
);
@endif

@if($message = Session::get('supply_system_status'))
swal(
    "",
    "{{ $message }}",
    "success"
);
@endif

$(document).on('click', '.filter-btn', function(e) {
    e.preventDefault();
    var data_filter = $(this).attr('data-filter');
    $.ajax({
        method: "GET",
        url: "{{ url('/product/filter') }}/" + data_filter,
        success: function(data) {
            $('tbody').html(data);
        }
    });
});

$(document).on('click', '.btn-edit', function() {
    var data_edit = $(this).attr('data-edit');
    $.ajax({
        method: "GET",
        url: "{{ url('/item/edit') }}/" + data_edit,
        success: function(response) {
            $('input[name=id]').val(response.items.id);
            $('input[name=kode_bahan]').val(response.items.kode_bahan);
            $('input[name=nama_bahan]').val(response.items.nama_bahan);
            $('input[name=warna]').val(response.items.warna);
            $('input[name=ukuran]').val(response.items.ukuran);
            $('input[name=stok]').val(response.items.stok);
            $('input[name=harga]').val(response.items.harga);
            validator.resetForm();
        }
    });
});

$(document).on('click', '.btn-delete', function(e) {
    e.preventDefault();
    var data_delete = $(this).attr('data-delete');
    swal({
            title: "Apa Anda Yakin?",
            text: "Data barang akan terhapus, klik oke untuk melanjutkan",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.open("{{ url('/item/delete') }}/" + data_delete, "_self");
            }
        });
});
</script>
@endsection