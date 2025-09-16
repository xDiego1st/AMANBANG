<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js" id="dynamic-body">

<head>
    <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-small.png') }}">
    <meta name="author" content="DISKOMINFO">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ config('app.name') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Page Title  -->
    <title> {{ $title }} | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    @notifyCss
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/skins/theme-blue.css') }}">
    <link rel="{{ asset('assets/css/libs/fontawesome-icons.css') }}">
    @filepondScripts
    @livewireStyles
</head>

<body class="nk-body bg-lighter npc-default has-apps-sidebar has-sidebar {{ session('darkMode') ? 'dark-mode' : '' }}">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed is-light" data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="{{ route('dashboard') }}" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="{{ asset('images/logo.png') }}" alt="logo">
                            <img class="logo-dark logo-img" src="{{ asset('images/logo.png') }}" alt="logo-dark">
                            <img class="logo-small logo-img logo-img-small" src="{{ asset('images/logo.png') }}"
                                srcset="{{ asset('images/logo.png') }}" alt="logo">
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="javascript:void(0)" class="nk-nav-toggle nk-quick-nav-icon d-xl-none"
                            data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="javascript:void(0)" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                            data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-heading">
                                    <h6 class="text-info overline-title text-primary-alt">Menu Aplikasi</h6>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-home-fill"></em></span>
                                        <span class="nk-menu-text">Dashboard
                                            <br>
                                            <small><small>Data Statistik & Informasi</small></small></span><span
                                            class="nk-menu-badge"></span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                @role(['ADMIN'])
                                    <li class="nk-menu-item">
                                        <a href="{{ route('operator.data.pengajuan.pemohon') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-table-view-fill"></em></span>
                                            <span class="nk-menu-text">Verifikasi & Penerbitan KRK
                                                <br>
                                                <small>
                                                    <small class="tb-amount-sub"><span
                                                            class="text-wrap text-primary">Memerlukan Verifikasi & Penerbitan KRK</span></small></small>

                                            </span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('operator.data.pengajuan.pemohon.belum.penomoran.simbg') }}"
                                            class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-table-view-fill"></em></span>
                                            <span class="nk-menu-text">Pendataan No.Registrasi SIMBG
                                                <br>
                                                <small>
                                                    <small class="tb-amount-sub"><span
                                                            class="text-wrap text-danger">Belum Terdata
                                                            Penomoran Registrasi SIMBG</span></small></small>
                                            </span>
                                        </a>
                                    </li>
                                @endrole

                                @role(['VERIFIKATOR', 'PENGAWAS', 'ADMIN'])
                                    {{-- <li class="nk-menu-item">
                                        <a href="{{ route('verifikator.data.pemohon') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-table-view-fill"></em></span>
                                            <span class="nk-menu-text">Data Pemohon
                                                <br>
                                                <small class="tb-amount-sub">Data Pengajuan Pemohon</small>
                                            </span>
                                        </a>
                                    </li> --}}
                                    <li class="nk-menu-item">
                                        <a href="{{ route('verifikator.list.signature.ba') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-table-view-fill"></em></span>
                                            <span class="nk-menu-text">Berita Acara
                                                <br>
                                                <small>
                                                    <small class="tb-amount-sub">Daftar Permintaan TTD BA Pemohon</small>
                                                </small>
                                            </span>
                                            {{-- <span class="nk-menu-badge">ADMIN</span> --}}
                                        </a>
                                    </li>
                                @endrole
                                @role(['VERIFIKATOR'])
                                    <li class="nk-menu-item">
                                        <a href="{{ route('verifikator.list.pengajuan.selesai') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-table-view-fill"></em></span>
                                            <span class="nk-menu-text">Riwayat Pengajuan
                                                <br>
                                                <small>
                                                    <small class="tb-amount-sub">Log Data Pengajuan</small>
                                                </small>
                                            </span>
                                            <span class="nk-menu-badge">Finish</span>
                                        </a>
                                    </li>
                                @endrole
                                @role(['ADMIN'])
                                    <li class="nk-menu-heading">
                                        <h6 class="text-info overline-title text-primary-alt">DATA MASTER</h6>
                                    </li><!-- .nk-menu-item -->
                                    <li class="nk-menu-item">
                                        <a href="{{ route('list.data.master.krk.pemohon') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-table-view-fill"></em></span>
                                            <span class="nk-menu-text">Rekap KRK Pemohon
                                                <br>
                                                <small>
                                                    <small class="tb-amount-sub">Daftar Pemohon Yang Telah Diberikan Berkas
                                                        KRK</small></small>
                                            </span>
                                        </a>
                                    </li>
                                @endrole
                                @role(['PEMOHON'])
                                    {{-- <li class="nk-menu-item">
                                        <a href="{{ route('pemohon.dashboard') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-home-fill"></em></span>
                                            <span class="nk-menu-text overline-title">Dashboard AMANBANG</span>
                                        </a>
                                    </li><!-- .nk-menu-item --> --}}
                                    <li class="nk-menu-item">
                                        <a href="{{ route('pemohon.pengajuan') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-table-view-fill"></em></span>
                                            <span class="nk-menu-text">Data Pengajuan Bangunan
                                                <br>
                                                <small><small>Data Pengajuan Bangunan PBG</small> </small>
                                            </span>

                                        </a>
                                    </li><!-- .nk-menu-item -->
                                    {{-- <li class="nk-menu-item">
                                        <a href="{{ route('pemohon.FormPageDataPemohon') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-upload-cloud"></em></span>
                                            <span class="nk-menu-text">Riwayat Upload</span>
                                        </a>
                                    </li><!-- .nk-menu-item --> --}}
                                @endrole
                                @role(['PEMOHON', 'ADMIN'])
                                    <li class="nk-menu-item">
                                        <a href="{{ route('list.data.master.prototype') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-label-fill"></em></span>
                                            <span class="nk-menu-text">Prototype Bangunan
                                                <br><small><small>Daftar Prototype Bangunan</small> </small>
                                            </span>
                                        </a>
                                    </li><!-- .nk-menu-item -->
                                @endrole
                                {{-- @role(['VERIFIKATOR', 'PENGAWAS'])
                                    <li class="nk-menu-item">
                                        <a href="{{ route('user.list') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-table-view-fill"></em></span>
                                            <span class="nk-menu-text">Pengaturan Tanda Tangan
                                                <br>
                                                <small> <small class="tb-amount-sub">Pengaturan Tanda Tangan Berkas Berita
                                                        Acara</small>
                                                </small>
                                            </span>
                                        </a>
                                    </li>
                                @endrole --}}

                                @role(['SUPER-ADMIN'])
                                    {{-- <li class="nk-menu-heading">
                                        <h6 class="overline-title text-primary-alt">DATA MASTER</h6>
                                    </li><!-- .nk-menu-item --> --}}

                                    {{-- <li class="nk-menu-item">
                                        <a href="{{ route('list.data.master.pbg') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-table-view-fill"></em></span>
                                            <span class="nk-menu-text">Data Pemohon PBG
                                                <br>
                                                <small>
                                                    <small class="tb-amount-sub">Data Master Pemohon PBG</small></small>
                                            </span>
                                        </a>
                                    </li> --}}
                                    {{-- <li class="nk-menu-item">
                                        <a href="{{ route('list.data.master.slf') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-table-view"></em></span>
                                            <span class="nk-menu-text">Data Pemohon SLF
                                                <br>
                                                <small>
                                                    <small class="tb-amount-sub">Data Master Pemohon SLF</small></small>
                                            </span>
                                        </a>
                                    </li> --}}
                                    <li class="nk-menu-heading">
                                        <h6 class="overline-title text-primary-alt">ACCOUNT</h6>
                                    </li><!-- .nk-menu-item -->

                                    <li class="nk-menu-item">
                                        <a href="{{ route('list.data.akun.pemohon') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                            <span class="nk-menu-text">Pemohon
                                                <br>
                                                <small>
                                                    <small class="tb-amount-sub">Daftar Akun Pemohon</small></small>
                                            </span>
                                        </a>
                                    </li>

                                    <li class="nk-menu-item">
                                        <a href="{{ route('list.data.akun.arsitektur') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-aperture"></em></span>
                                            <span class="nk-menu-text">Ahli Arsitektur
                                                <br>
                                                <small>
                                                    <small class="tb-amount-sub">Daftar Akun Ahli
                                                        Arsitektur</small></small>
                                            </span>
                                            <span class="nk-menu-badge">TPA</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('list.data.akun.struktur') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-b-opera"></em></span>
                                            <span class="nk-menu-text">Ahli Struktur
                                                <br>
                                                <small>
                                                    <small class="tb-amount-sub">Daftar Akun Ahli Struktur</small></small>

                                            </span>
                                            <span class="nk-menu-badge">TPA</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('list.data.akun.utilitas') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-globe"></em></span>
                                            <span class="nk-menu-text">Ahli Utilitas
                                                <br>
                                                <small>
                                                    <small class="tb-amount-sub">Daftar Akun Ahli Mekanikal Elektrikal
                                                        Plumbing</small></small>
                                            </span>
                                            <span class="nk-menu-badge">TPA</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('list.data.akun.verifikator-slf') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-grid-fill"></em></span>
                                            <span class="nk-menu-text">Verifikator SLF
                                                <br>
                                                <small>
                                                    <small class="tb-amount-sub">Daftar Akun Verifikator
                                                        SLF</small></small>
                                            </span>
                                            <span class="nk-menu-badge">TPT</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('list.data.akun.pengawas') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em
                                                    class="icon ni ni-activity-round-fill"></em></span>
                                            <span class="nk-menu-text">Pengawas
                                                <br>
                                                <small>
                                                    <small class="tb-amount-sub">Daftar Akun Pengawas</small></small>
                                            </span>
                                        </a>
                                    </li>
                                    {{-- <li class="nk-menu-item">
                                        <a href="{{ route('user.list') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-table-view-fill"></em></span>
                                            <span class="nk-menu-text">Dokumen Pengajuan
                                                <br>
                                                <small>
                                                    <small class="tb-amount-sub">Daftar Upload Dokumen
                                                        Pemohon</small></small>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('user.list') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-table-view-fill"></em></span>
                                            <span class="nk-menu-text">Account Pemohon
                                                <br>
                                                <small>
                                                    <small class="tb-amount-sub">Daftar Account Pemohon</small></small>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('user.list') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-table-view-fill"></em></span>
                                            <span class="nk-menu-text">Account Verifikator
                                                <br>
                                                <small>
                                                    <small class="tb-amount-sub">Daftar Account Verifikator</small></small>
                                            </span>
                                        </a>
                                    </li> --}}
                                    <li class="nk-menu-heading">
                                        <h6 class="overline-title text-primary-alt">MANAGEMENT</h6>
                                    </li><!-- .nk-menu-item -->

                                    <li class="nk-menu-item">
                                        <a href="{{ url('web/settings') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-setting-fill"></em></span>
                                            <span class="nk-menu-text">Web Settings
                                                <br>
                                                <small class="tb-amount-sub">General Settings</small>
                                            </span><span class="nk-menu-badge badge-danger">Super Admin</span>
                                        </a>
                                    </li><!-- .nk-menu-item -->
                                    <li class="nk-menu-item">
                                        <a href="{{ route('user.list') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-table-view-fill"></em></span>
                                            <span class="nk-menu-text">User
                                                <br>
                                                <small class="tb-amount-sub">Data Pengguna</small>
                                            </span><span class="nk-menu-badge">Admin</span>
                                        </a>
                                    </li>
                                @endrole
                                {{-- <li class="nk-menu-item">
                                    <a href="{{ url('/backup-list') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-setting-fill"></em></span>
                                <span class="nk-menu-text">Backups
                                    <br>
                                    <small class="tb-amount-sub">Backup Database</small></span>
                                <span class="nk-menu-badge">ADMIN</span>
                                </a>
                                </li><!-- .nk-menu-item --> --}}
                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">Profile</h6>
                                </li><!-- .nk-menu-item -->

                                <li class="nk-menu-item">
                                    <a href="{{ route('profile.show') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-setting-fill"></em></span>
                                        <span class="nk-menu-text">Profile Settings
                                            <br>
                                            <small class="tb-amount-sub">Settings Account</small></span>
                                    </a>
                                </li><!-- .nk-menu-item -->

                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">

                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1">
                                <a href="javascript:void(0)" class="nk-nav-toggle nk-quick-nav-icon"
                                    data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            {{-- <div class="nk-header-brand d-xl-none">
                                <a href="/" class="logo-link">
                                    <img class="logo-light logo-img" src="{{ asset('images/logo.png') }}" alt="logo">
                                    <img class="logo-dark logo-img" src="{{ asset('images/logo.png') }}" alt="logo-dark">
                                </a>
                            </div><!-- .nk-header-brand --> --}}
                            <div class="nk-header-search ms-3 ms-xl-0">
                                <ol class="p-2 m-0 border-0 breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </ol>
                            </div><!-- .nk-header-news -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">

                                    <ul class="nk-quick-nav">
                                        <div class="nk-news-icon">
                                            <em class="icon ni ni-calender-date"></em>
                                        </div>
                                        <div class="user-name">
                                            <p>{{ date_today() }}&nbsp;&nbsp;</p>
                                        </div>
                                    </ul>
                                    {{-- <li class="dropdown notification-dropdown">
                                        <a href="javascript:void(0)" class="dropdown-toggle nk-quick-nav-icon"
                                            data-bs-toggle="dropdown">
                                            <div class="icon-status icon-status-info"><em
                                                    class="icon ni ni-bell"></em></div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                            <div class="dropdown-head">
                                                <span class="sub-title nk-dropdown-title">Notifications</span>
                                                <a href="javascript:void(0)">Mark All as Read</a>
                                            </div>
                                            <div class="dropdown-body">
                                                <div class="nk-notification">
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em
                                                                class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">You have requested to
                                                                <span>Widthdrawl</span>
                                                            </div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em
                                                                class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">Your <span>Deposit
                                                                    Order</span> is placed</div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em
                                                                class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">You have requested to
                                                                <span>Widthdrawl</span>
                                                            </div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em
                                                                class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">Your <span>Deposit
                                                                    Order</span> is placed</div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em
                                                                class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">You have requested to
                                                                <span>Widthdrawl</span>
                                                            </div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em
                                                                class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">Your <span>Deposit
                                                                    Order</span> is placed</div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                </div><!-- .nk-notification -->
                                            </div><!-- .nk-dropdown-body -->
                                            <div class="dropdown-foot center">
                                                <a href="javascript:void(0)">View All</a>
                                            </div>
                                        </div>
                                    </li> --}}
                                    <li class="dropdown user-dropdown">
                                        <a href="javascript:void(0)" class="dropdown-toggle me-n1"
                                            data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <x-user-avatar />
                                                <div class="user-info d-none d-xl-block">
                                                    <div
                                                        class="user-status overline-title {{ \App\Models\User::ROLES[$user->role]['text-color'] }}">
                                                        {{ \App\Models\User::ROLES[$user->role]['role'] }}
                                                    </div>
                                                    <div class="user-name dropdown-indicator">
                                                        {{ Auth::user()->name ?? Auth::user()->username }}
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <x-user-avatar />
                                                    <div class="user-info">
                                                        <span class="lead-text">{{ Auth::user()->email }}</span>
                                                        <span class="sub-text">Last Login At :
                                                            <br>{{ $user->last_login_at }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="{{ route('profile.show') }}"><em
                                                                class="icon ni ni-user-alt"></em><span>View
                                                                Profile</span></a></li>
                                                    <li><a href="{{ route('profile.show') }}"><em
                                                                class="icon ni ni-setting-alt"></em><span>Account
                                                                Setting</span></a></li>
                                                    <li><a href="{{ route('profile.show') }}"><em
                                                                class="icon ni ni-activity-alt"></em><span>Login
                                                                Activity</span></a></li>
                                                    <li><a class="dark-switch" onclick="toggleDarkMode()"
                                                            href="javascript:void(0)"><em
                                                                class="icon ni ni-moon"></em><span>Dark Mode</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li>
                                                        <form method="POST" action="{{ route('logout') }}">
                                                            @csrf
                                                            <a href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();this.closest('form').submit();"
                                                                role="button">
                                                                <em class="icon ni ni-signout"></em><span>Sign
                                                                    out</span>
                                                            </a>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content" id="BaseContent">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                <!-- footer @s -->
                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright">
                                <small> <a href="https://amanbang.pekanbaru.go.id"
                                        class="nav-link">amanbang.pekanbaru.go.id - Portal Resmi Aplikasi Manajemen
                                        Bangunan Gedung Untuk Pemohon PBG </a> </small>
                            </div>
                            <div class="nk-footer-links"> <small>
                                    &copy; 2024 PUPR PEKANBARU. Copyright By <a href="https://simbg.pu.go.id/"
                                        target="_blank">DISKOMINFO</a></small>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>

    <!-- CSS SCRIPT -->
    <link rel="stylesheet" href="{{ asset('assets/css/editors/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/editors/tinymce.css') }}">
    <!-- CSS SCRIPT -->
    <!-- JavaScript -->
    <script src="{{ asset('assets/js/bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/libs/editors/summernote.js') }}"></script>
    <script src="{{ asset('assets/js/editors.js') }}"></script>
    <script src="{{ asset('assets/js/libs/editors/tinymce.js') }}"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

    <script src="{{ asset('js/custom-scripts.js') }}"></script>
    <script src="{{ asset('assets/js/example-sweetalert.js') }}"></script>
    @livewireScripts
    @stack('scripts')

    @include('notify::components.notify')
    @notifyJs
    @if (session()->has('alert'))
        <div x-data="{
            init() {
                this.$nextTick(() => {
                    this.$dispatch('showAlert', {{ json_encode([session('alert')]) }});
                })
            }
        }"></div>
    @endif
</body>

</html>
