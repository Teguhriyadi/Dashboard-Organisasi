@extends('pages.layouts.main')

@section('title', 'Detail Data Panic')

@section('component-css')
    <link href="{{ URL::asset('template') }}/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{ URL::asset('template') }}/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css"
        rel="stylesheet">
    <link href="{{ URL::asset('template') }}/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css"
        rel="stylesheet">
    <link href="{{ URL::asset('template') }}/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css"
        rel="stylesheet">
    <link href="{{ URL::asset('template') }}/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css"
        rel="stylesheet">
@endsection

@section('content-page')

    @php
        $lokasi = json_decode($detail['lokasi']);
    @endphp
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    @yield('title')
                </h3>
            </div>
        </div>

        <div class="clearfix"></div>

        @if (session('success'))
            <div class="alert alert-success text-uppercase">
                <strong>Berhasil</strong>, {!! session('success') !!}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger text-uppercase">
                <strong>Gagal</strong>, {!! session('error') !!}
            </div>
        @endif

        <a href="{{ route('pages.report.panic.index', ['member_account_code' => session('data')['member_account_code']]) }}"
            class="btn btn-danger" style="margin-top: 5px;">
            <i class="fa fa-sign-out"></i> Kembali
        </a>
        <a target="_blank" href="https://www.google.com/maps/place/{{ $lokasi->latitude }},{{ $lokasi->longitude }}" class="btn btn-primary" style="margin-top: 5px;">
            Lihat Lokasi Kejadian
        </a>

        <div class="row" style="margin-top: 10px">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            @yield('title')
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                Nama
                            </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                {{ $detail['name'] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                Kode Member
                            </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                {{ $detail['member_code'] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                Latitude
                            </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                {{ $lokasi->latitude }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                Longitude
                            </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                @php
                                    $lokasi = json_decode($detail['lokasi']);
                                @endphp
                                {{ $lokasi->longitude }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                Nomor HP
                            </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                {{ $detail['phone_number'] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                Status
                            </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                @if ($detail['status'] == 'P')
                                    <button disabled class="btn btn-danger btn-sm fw-bold text-uppercase">
                                        Sedang Ditangani
                                    </button>
                                @elseif($detail['status'] == 'W')
                                    <button disabled class="btn btn-warning btn-sm fw-bold text-uppercase">
                                        Menunggu
                                    </button>
                                @elseif($detail['status'] == 'D')
                                    <button disabled class="btn btn-success btn-sm fw-bold text-uppercase">
                                        Selesai
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            Detail Data Responder
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                Nama Responder
                            </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                {{ $detail['responder_name'] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                Nomor HP Responder
                            </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                {{ $detail['phone_number_responder'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
