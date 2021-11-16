@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/manage_product/new_product/style.css') }}">
@endsection
@section('content')
<div class="row page-title-header">
    <div class="col-12">
        <div class="page-header d-flex justify-content-start align-items-center">
            <div class="quick-link-wrapper d-md-flex flex-md-wrap">
                <ul class="quick-links">
                    <li><a href="{{ url('item') }}">Daftar Bahan</a></li>
                    <li><a href="{{ url('item/new') }}">Bahan Baru</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 col-md-12 col-sm-12 mb-4">
        <div class="card card-noborder b-radius">
            <div class="card-body">
                <form action="{{ url('/item/create') }}" method="post" name="create_form">
                    @csrf
                    <!-- <div class="form-group row">
                        <label class="col-12 font-weight-bold col-form-label">Kode Bahan <span
                                class="text-danger">*</span></label>
                        <div class="col-12">
                            <div class="input-group">
                                <input type="text" class="form-control number-input" name="randomString" readonly>
                                <div class="inpu-group-prepend">
                                    <button class="btn btn-inverse-primary btn-sm btn-scan shadow-sm ml-2" type="button"
                                        data-toggle="modal" data-target="#scanModal"><i
                                            class="mdi mdi-crop-free"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 error-notice" id="kode_barang_error"></div>
                    </div> -->
                    <div class="form-group row">
                        <div class="col-lg-8 col-md-6 col-sm-12 space-bottom">
                            <div class="row">
                                <label class="col-12 font-weight-bold col-form-label">Nama Bahan <span
                                        class="text-danger">*</span></label>
                                <div class="col-12">
                                    <input type="text" class="form-control" name="nama_bahan"
                                        placeholder="Masukkan Nama Bahan">
                                </div>
                                <div class="col-12 error-notice" id="nama_barang_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-8 col-md-6 col-sm-12 space-bottom">
                            <div class="row">
                                <label class="col-12 font-weight-bold col-form-label">Warna</label>
                                <div class="col-12">

                                    <div class="input-group-append">
                                        <select class="form-control" name="warna">
                                            <option value="Silver">Silver</option>
                                            <option value="Coklat">Coklat</option>
                                            <option value="Putih">Putih</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-8 col-md-6 col-sm-12 space-bottom">
                            <div class="row">
                                <label class="col-12 font-weight-bold col-form-label">Ukuran</label>
                                <div class="col-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control number-input" name="ukuran"
                                            placeholder="Masukkan ukuran bahan">
                                        <div class="input-group-append">
                                            <select class="form-control" name="ukuran_bahan">
                                                <option value="m">Meter</option>
                                                <option value="cm">Centimeter</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        @if($supply_system->status == true)
                        <div class="col-lg-8 col-md-6 col-sm-12 space-bottom">
                            <div class="row">
                                <label class="col-12 font-weight-bold col-form-label">Stok Bahan <span
                                        class="text-danger">*</span></label>
                                <div class="col-12">
                                    <input type="text" class="form-control number-input" name="stok"
                                        placeholder="Masukkan Stok Bahan">
                                </div>
                                <div class="col-12 error-notice" id="stok_error"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="from-group row">
                        <div class="col-lg-8 col-md-6 col-sm-12 space-bottom">
                            <div class="row">
                                <label class="col-12 font-weight-bold col-form-label">Harga Bahan <span
                                        class="text-danger">*</span></label>
                                <div class="col-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp. </span>
                                        </div>
                                        <input type="text" class="form-control number-input" name="harga"
                                            placeholder="Masukkan Harga Bahan">
                                    </div>
                                </div>
                                <div class="col-12 error-notice" id="harga_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2 d-flex justify-content-start">
                            <button class="btn btn-simpan btn-sm" type="submit"><i class="mdi mdi-content-save"></i>
                                Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('plugins/js/quagga.min.js') }}"></script>
<script src="{{ asset('js/manage_product/new_product/script.js') }}"></script>
<script type="text/javascript">

</script>
@endsection