@extends('pages.layouts.main')

@section('title', 'Akun User ' . $detail['detail']['nama'])

@section('content-page')

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

        <a href="{{ route('pages.account.responder.index-admin', ['member_account_code' => session('data.member_account_code')]) }}" class="btn btn-danger" style="margin-top: 5px;">
            <i class="fa fa-sign-out"></i> Kembali
        </a>

        <div class="row" style="margin-top: 10px">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            Detail @yield('title')
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                Nama
                            </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                {{ $detail['detail']['nama'] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                Username
                            </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                {{ $detail['detail']['username'] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                Kode Member Akun
                            </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                {{ $detail['detail']['member_account_code'] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                Kode Negara
                            </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                {{ $detail['detail']['country_code'] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                Nomor HP
                            </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                {{ $detail['detail']['phone_number'] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12">
                                Status
                            </label>
                            <div class="col-md-5 col-sm-9 col-xs-12 text-uppercase">
                                {{ $detail['detail']['account_status_id'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            Detail MemberShip
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                Nama Paket
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 text-uppercase">
                                {{ $detail['detail']['detailMembership']['active_paket'] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                Status Subscribe
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                {{ $detail['detail']['detailMembership']['status_subscribe'] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                Durasi Waktu
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                {{ $detail['detail']['detailMembership']['returnDate'] }} Hari
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
