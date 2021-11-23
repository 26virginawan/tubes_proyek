@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/report/report_transaction/style.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/css/datedropper.css') }}">
@endsection
@section('content')
<div class="row page-title-header">
    <div class="col-12">
        <div class="page-header d-flex justify-content-between align-items-center">
            <h4 class="page-title">Laporan Transaksi</h4>
            <div class="print-btn-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="mdi mdi-export print-icon"></i>
                        </div>
                        <button class="btn btn-print" type="button" data-toggle="modal" data-target="#cetakModal">Export
                            Laporan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-12 grid-margin">
        <div class="card card-noborder b-radius">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <ul class="list-date">
                            @foreach($dates as $date)
                            <li class="txt-light">{{ date('d M, Y', strtotime($date)) }}</li>
                            @php
                            $transactions = \App\Transaction::select('kode_transaksi')
                            ->whereDate('transactions.created_at', $date)
                            ->distinct()
                            ->latest()
                            ->get();
                            @endphp
                            <div class="table-responsive">
                                <table class="table table-custom">
                                    <tr>
                                        <th>Kode Transaksi</th>
                                        <th>Total</th>
                                        <th>Bayar</th>
                                        <th>Kembali</th>
                                        <th></th>
                                    </tr>
                                    @foreach($transactions as $transaction)
                                    <tr>
                                        @php
                                        $transaksi = \App\Transaction::where('kode_transaksi',
                                        $transaction->kode_transaksi)
                                        ->select('transactions.*')
                                        ->first();
                                        $products = \App\Transaction::where('kode_transaksi',
                                        $transaction->kode_transaksi)
                                        ->select('transactions.*')
                                        ->get();
                                        $tgl_transaksi = \App\Transaction::where('kode_transaksi', '=' ,
                                        $transaction->kode_transaksi)
                                        ->select('created_at')
                                        ->first();
                                        @endphp
                                        <td class="td-1">
                                            <span
                                                class="d-block font-weight-bold big-font">{{ $transaction->kode_transaksi }}</span>
                                            <span
                                                class="d-block mt-2 txt-light">{{ date('d M, Y', strtotime($tgl_transaksi->created_at)) . ' pada ' . date('H:i', strtotime($tgl_transaksi->created_at)) }}</span>
                                        </td>
                                        <td><span class="ammount-box bg-green"><i class="mdi mdi-coin"></i></span>Rp.
                                            {{ number_format($transaksi->total,2,',','.') }}</td>
                                        <td class="text-success font-weight-bold">- Rp.
                                            {{ number_format($transaksi->bayar,2,',','.') }}</td>
                                        <td>Rp. {{ number_format($transaksi->kembali,2,',','.') }}</td>

                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('plugins/js/datedropper.js') }}"></script>
<script src="{{ asset('js/report/report_transaction/script.js') }}"></script>
<script type="text/javascript">
var ctx = document.getElementById('myChart').getContext('2d');


$(document).on('submit', 'form[name=filter_form]', function(e) {
    e.preventDefault();
    var request = new FormData(this);
    $.ajax({
        url: "{{ url('/report/transaction/filter') }}",
        method: "POST",
        data: request,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            $('.list-date').html(data);
        }
    });
});

$(document).on('click', '.chart-filter', function(e) {
    e.preventDefault();
    var data_filter = $(this).attr('data-filter');
    if (data_filter == 'minggu') {
        $('.btn-filter-chart').html('1 Minggu Terakhir');
    } else if (data_filter == 'bulan') {
        $('.btn-filter-chart').html('1 Bulan Terakhir');
    } else if (data_filter == 'tahun') {
        $('.btn-filter-chart').html('1 Tahun Terakhir');
    }
    $.ajax({
        url: "{{ url('/report/transaction/chart') }}/" + data_filter,
        method: "GET",
        success: function(response) {
            if (response.incomes.length != 0) {
                changeData(myChart, response.incomes, response.total);
            }
        }
    });
});
</script>
@endsection