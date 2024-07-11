@extends('pages.layouts.main')

@section('title', 'Dashboard')

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

        @if (session("category_account") == "INTERNAL")
            <div class="alert alert-info text-uppercase">
                anda saat ini dalam mode
                <strong>
                    paket basic
                </strong>. silahkan melakukan upgrade paket ke
                <strong>
                    silver / gold
                </strong>.
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="count">
                                {{ $totalResponder }}
                            </div>
                            <h3>Responder</h3>
                            <a href="{{ route('pages.account.responder.index-admin', ['member_account_code' => session("data")["member_account_code"]]) }}" class="btn btn-secondary btn-sm btn-block" style="margin-top: 10px;">
                                <i class="fa fa-sign-in"></i> Pergi Ke Halaman
                            </a>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="count">
                                {{ $totalUser }}
                            </div>
                            <h3>User</h3>
                            <a href="{{ route('pages.accounts.user.index-admin', ['member_account_code' => session("data")["member_account_code"]]) }}" class="btn btn-secondary btn-sm btn-block" style="margin-top: 10px;">
                                <i class="fa fa-sign-in"></i> Pergi Ke Halaman
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            Detail Paket
                        </h2>
                        <a href="{{ route('pages.account.profil.index') }}" class="btn btn-primary btn-sm pull-right">
                            Upgrade
                        </a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-4">
                                Nama Paket
                            </div>
                            <div class="col-md-5">
                                {{ $showDetail["detailMembership"]["nama_paket"] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                Status Subscribe
                            </div>
                            <div class="col-md-5">
                                {{ $showDetail["detailMembership"]["status_subscribe"] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                Durasi Waktu
                            </div>
                            <div class="col-md-5">
                                {{ $showDetail["detailMembership"]["remainingDate"] }} Hari
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
