@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/dashboard/style.css') }}">
@endsection
@section('content')
<div class="row page-title-header">
    <div class="col-12">
        <div class="page-header d-flex justify-content-between align-items-center">
            <h4 class="page-title">Dashboard</h4>
            <!-- <button class="setting-btn" data-toggle="modal" data-target="#pengaturanTokoModal">
                Pengaturan Toko
            </button> -->
        </div>
    </div>
</div>


@endsection
@section('script')
<script src="{{ asset('js/dashboard/script.js') }}"></script>
<script src="{{ asset('plugins/js/Chart.min.js') }}"></script>
<script src="{{ asset('plugins/js/ChartRadius.js') }}"></script>
<script type="text/javascript">
@if($message = Session::get('update_success'))
swal(
    "Berhasil!",
    "{{ $message }}",
    "success"
);
@endif
</script>
@endsection