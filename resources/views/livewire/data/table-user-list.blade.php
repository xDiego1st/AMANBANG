<div class="container-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between g-3">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title"> Daftar Akun
                            <span class="badge {{ config('styles.type_validator.'.$type_validator.'.class') }} ">{{ config('styles.type_validator.'.$type_validator.'.text') }}</span>
                        </h3>
                        <div class="nk-block-des text-soft d-none d-md-inline-flex">
                            <ul class="breadcrumb breadcrumb-pipe">
                                <li class="breadcrumb-item active"><a wire:click.prevent="$set('f_role',null)"
                                        href="javascript:void(0)">Ditemukan : <span
                                            class="cursor-pointer badge bg-secondary link-on-success"> Total
                                            ({{ $totalData }})</span></a></li>
                                {{-- @foreach ($userRoles as $role => $r)
                                    @if ($role != 'SUPER-ADMIN')
                                        <li class="breadcrumb-item"> <a
                                                wire:click.prevent="$set('f_role','{{ $role }}')"
                                                class="cursor-pointer badge {{ $r['bg-color'] . ' ' . $r['text-color'] }} link-on-primary ">{{ $r['role'] }}</a>
                                        </li>
                                    @endif
                                @endforeach --}}
                            </ul>
                        </div>
                    </div>
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="javascript:void(0)" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <a wire:click.prevent="export" href="javascript:void(0)"
                                            class="btn btn-white btn-outline-light"><em
                                                class="icon ni ni-download-cloud"></em><span>Export</span></a>
                                    </li>
                                    <li class="nk-block-tools-opt">
                                        <div class="drodown">
                                            <a href="javascript:void(0)" class="dropdown-toggle btn btn-icon btn-primary"
                                                data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="javascript:void(0)"
                                                            wire:click.prevent="openModalDetail('ModalFormUser')"><span>Add
                                                                User</span></a></li>
                                                    <li><a href="javascript:void(0)"><span>Import User</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .toggle-wrap -->
                    </div><!-- .nk-block-head-content -->
                </div>
            </div><!-- .nk-block-head -->

            <div class="nk-block">
                <div class="card card-bordered card-stretch">
                    <div class="card-inner-group">

                        <div class="card-inner position-relative card-tools-toggle">
                            <div class="card-title-group">
                                @if ($user->role == 'FASKES' || $user->role == 'DUKCAPIL')
                                    <div class="card-title">
                                        <h5 class="title">Data Peserta</h5>
                                    </div>
                                @endif

                                <div class="card-tools">
                                    <div class="form-inline flex-nowrap gy-3 gx-3">
                                        <div class="form-wrap w-200px" wire:ignore>
                                            <select id="selectBulkAction" class="form-select js-select2"
                                                data-search="on" data-placeholder="Bulk Action" wire:model="bulkAction"
                                                onchange="return setSelectBox('selectBulkAction','bulkAction');">
                                                <option value="">Bulk Action</option>
                                                @role(['SUPER-ADMIN'])
                                                    <option value="delete">Delete</option>
                                                @endrole
                                            </select>
                                        </div>

                                        <div class="btn-wrap">
                                            <span class="d-none d-md-block"><button
                                                    class="btn btn-dim btn-outline-light {{ isset($bulkAction) ? '' : 'disabled' }}"
                                                    wire:click.prevent="bulkButton">Apply</button></span>
                                            <span class="d-md-none"><button
                                                    class="btn btn-dim btn-outline-light btn-icon disabled">
                                                    <em class="icon ni ni-arrow-right"></em></button>
                                            </span>
                                        </div>
                                    </div><!-- .form-inline -->
                                </div><!-- .card-tools -->

                                <div class="card-tools me-n1">
                                    <ul class="btn-toolbar gx-1">
                                        <li>
                                            <a href="javascript:void(0)"
                                                class="btn btn-icon search-toggle toggle-search text-warning"
                                                data-target="search"><em class="icon ni ni-search"></em></a>
                                        </li><!-- li -->
                                        <li class="btn-toolbar-sep"></li><!-- li -->
                                        <li>
                                            <div class="toggle-wrap">
                                                {{-- <a href="javascript:void(0)" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-menu-right"></em></a> --}}
                                                <div class="toggle-content" data-content="cardTools">
                                                    <ul class="btn-toolbar gx-1">
                                                        <li class="toggle-close">
                                                            <a href="javascript:void(0)" class="btn btn-icon btn-trigger toggle"
                                                                data-target="cardTools"><em
                                                                    class="icon ni ni-arrow-left"></em></a>
                                                        </li><!-- li -->
                                                        {{-- <li>
                                                            <div class="dropdown">
                                                                <a href="javascript:void(0)" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                                                    <div class="dot dot-primary"></div>
                                                                    <em class="icon ni ni-filter-alt"></em>
                                                                </a>
                                                                <div class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                                                    <div class="dropdown-head">
                                                                        <span class="sub-title dropdown-title">Filter
                                                                            Appointment</span>
                                                                        <div class="dropdown">
                                                                            <a href="javascript:void(0)" class="btn btn-sm btn-icon">
                                                                                <em class="icon ni ni-more-h"></em>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-foot between">
                                                                        <a class="text-center clickable" href="javascript:void(0)">Reset
                                                                            Filter</a>
                                                                    </div>
                                                                </div><!-- .filter-wg -->
                                                            </div><!-- .dropdown -->
                                                        </li><!-- li --> --}}
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-trigger btn-icon dropdown-toggle"
                                                                    data-bs-toggle="dropdown">
                                                                    <em class="icon ni ni-setting text-info"></em>
                                                                </a>
                                                                <div
                                                                    class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                                    <ul class="link-check">
                                                                        <li><span>Show</span></li>
                                                                        @foreach ($show as $s)
                                                                            <li
                                                                                class="{{ $perPage == $s ? 'active' : '' }}">
                                                                                <a href="javascript:void(0)"
                                                                                    wire:click.prevent="$set('perPage',{{ $s }} )">{{ $s }}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                    <ul class="link-check">
                                                                        <li><span>Order</span></li>
                                                                        <li
                                                                            class="{{ $order == 'asc' ? 'active' : '' }}">
                                                                            <a href="javascript:void(0)"
                                                                                wire:click.prevent="$set('order','asc')">ASC</a>
                                                                        </li>
                                                                        <li
                                                                            class="{{ $order == 'desc' ? 'active' : '' }}">
                                                                            <a href="javascript:void(0)"
                                                                                wire:click.prevent="$set('order','desc')">DESC</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div><!-- .dropdown -->
                                                        </li><!-- li -->
                                                        @if ($user->role == 'ADMIN')
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    wire:click.prevent="toggleSwitchTrash"
                                                                    class="btn btn-trigger btn-icon ">
                                                                    <em
                                                                        class="icon ni {{ $withTrash ? 'ni-cross' : 'ni-trash' }}"></em>
                                                                </a>
                                                            </li><!-- li -->
                                                        @endif
                                                    </ul><!-- .btn-toolbar -->
                                                </div><!-- .toggle-content -->
                                            </div><!-- .toggle-wrap -->
                                        </li><!-- li -->
                                    </ul><!-- .btn-toolbar -->
                                </div><!-- .card-tools -->
                            </div><!-- .card-title-group -->
                            <div class="card-search search-wrap" data-search="search" wire:ignore>
                                <div class="card-body">
                                    <div class="search-content">
                                        <a href="javascript:void(0)" class="search-back btn btn-icon toggle-search"
                                            data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                        <input wire:model.live="textSearch" type="text"
                                            class="border-transparent form-control form-focus-none"
                                            placeholder="Search by name or id">
                                        <button class="search-submit btn btn-icon"><em
                                                class="icon ni ni-search text-success"></em></button>
                                    </div>
                                </div>
                            </div><!-- .card-search -->
                        </div><!-- .card-inner -->

                        <div class="p-0 card-inner">
                            <div class="nk-tb-list nk-tb-ulist">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="uid-all"
                                                wire:model.live='selectAll'>
                                            <label class="custom-control-label" for="uid-all"></label>
                                        </div>
                                    </div>
                                    <div class="nk-tb-col"><span>Name</span></div>
                                    <div class="nk-tb-col tb-col-xl"><span>Username</span></div>
                                    <div class="nk-tb-col tb-col-xl"><span>Role</span></div>
                                    <div class="nk-tb-col tb-col-xxl"><span>Last Login</span></div>
                                    <div class="nk-tb-col tb-col-xl"><span>2FA</span></div>
                                    <div class="nk-tb-col tb-col-xl"><span>Status</span></div>
                                    <div class="nk-tb-col nk-tb-col-tools text-end">
                                        <div class="dropdown">
                                            <a href="javascript:void(0)"
                                                class="btn btn-xs btn-outline-light btn-icon dropdown-toggle"
                                                data-bs-toggle="dropdown" data-offset="0,5" aria-expanded="false"><em
                                                    class="icon ni ni-plus"></em></a>
                                            <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end"
                                                style="">
                                                <ul class="link-tidy sm no-bdr">
                                                    <li>
                                                        <div
                                                            class="custom-control custom-control-sm custom-checkbox checked">
                                                            <input type="checkbox" class="custom-control-input"
                                                                checked="" id="bl">
                                                            <label class="custom-control-label"
                                                                for="bl">Balance</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                @foreach ($data as $i)
                                    <div class="nk-tb-item" wire:key="{{ $i->id }}">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="uid{{ $i->id }}" wire:model="selected"
                                                    value="{{ $i->id }}">
                                                <label class="custom-control-label"
                                                    for="uid{{ $i->id }}"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col">
                                            <div class="user-card">
                                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                    @if ($i->profile_photo_path)
                                                        <img class="user-avatar sm d-none d-sm-flex"
                                                            src="{{ $i->profile_photo_url }}">
                                                    @else
                                                        <img class="user-avatar sm d-none d-sm-flex"
                                                            src="{{ Avatar::create($i->name)->toBase64() }}">
                                                    @endif
                                                @endif
                                                <div class="user-info">
                                                    <span class="tb-lead">{{ $i->name }} <span
                                                            class="dot dot-success d-md-none ms-1"></span></span>
                                                    <span>{{ $i->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-mb">
                                            <span class="tb-amount-sm">{{ $i->username }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-mb">
                                            <span class="badge {{ $i->roleColor() }}">{{ $i->role }}</span>
                                            <span class="badge {{ $i->type_validator_color() }}">{{ $i->type_validator_name() }}</span>
                                            <span class="badge badge-dim bg-primary">{{ $i->jenis_user }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-lg">
                                            <span>{{ Carbon::parse($i->last_seen)->diffForHumans() }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-lg">
                                            <span>
                                                @if ($i->two_factor_secret != null)
                                                    <span class="badge bg-success">Enable</span>
                                                @else
                                                    <span class="badge bg-danger">Disable</span>
                                                @endif
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            @if (Cache::has('user-is-online-' . $i->id))
                                                <span class="tb-status text-success">Online</span>
                                            @else
                                                <span class="tb-status text-secondary">Offline</span>
                                            @endif
                                        </div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="javascript:void(0)"
                                                        wire:click.prevent="$dispatch('openUserFormModal', { id: '{{ $i->id }}' })"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit Informartion">
                                                        <em class="icon ni ni-edit-fill"></em>
                                                    </a>
                                                </li>
                                                <li>
                                                    <div class="drodown">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-toggle btn btn-icon btn-trigger"
                                                            data-bs-toggle="dropdown"><em
                                                                class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="javascript:void(0)"
                                                                        wire:click.prevent="openModalAsk('Reset Password',{{ $i->id }})"><em
                                                                            class="icon ni ni-shield-star"></em><span>Reset
                                                                            Pass</span></a></li>
                                                                <li><a href="javascript:void(0)"
                                                                        wire:click.prevent="openModalAsk('Reset 2FA',{{ $i->id }})"><em
                                                                            class="icon ni ni-shield-off"></em><span>Reset
                                                                            2FA</span></a></li>
                                                                <li><a href="javascript:void(0)"
                                                                        wire:click.prevent="openModalAsk('Remove Account',{{ $i->id }})"><em
                                                                            class="icon ni ni-na"></em><span>Remove
                                                                            User</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- .nk-tb-item  -->
                                @endforeach
                            </div><!-- .nk-tb-list -->
                            @if ($data->isEmpty())
                                <div class="py-2 row justify-content-center">
                                    <div class="text-center nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h3 class="badge bg-danger">Tidak ada Data yang ditemukan.</h3>
                                        </div>
                                    </div>
                                    <div class="text-center nk-block-head" wire:loading wire:target='search'>
                                        <div class="nk-block-head-content">
                                            <h3 class="badge bg-danger">Loading...</h3>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div><!-- .card-inner -->

                        <div class="card-inner">
                            {{ $data->links('layouts.pagination-links') }}
                        </div><!-- .card-inner -->

                    </div><!-- .card-inner-group -->
                </div><!-- .card-bordered -->
            </div><!-- .card -->
        </div><!-- .nk-block -->
    </div>
    @livewire('modals.user-form-modal')
</div>

@push('scripts')
    <style>
        /* LivewireLoading.css */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .loading-icon {
            animation: spin 1s linear infinite;
            font-size: 40px;
            color: white;
        }

        .loading-message {
            margin-top: 10px;
            font-size: 16px;
            color: white;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush
