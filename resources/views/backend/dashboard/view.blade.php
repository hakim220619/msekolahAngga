@extends('backend.layout.base')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4>{{ $title }}</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ Helper::apk()->nama_owner }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript: void(0);">{{ $title }}</a></li>
                </ol>
            </div>
        </div>
        {{-- <div class="col-sm-6">
            <div class="state-information d-none d-sm-block">
                <div class="state-graph">
                    <div id="header-chart-1"></div>
                    <div class="info">Balance $ 2,317</div>
                </div>
                <div class="state-graph">
                    <div id="header-chart-2"></div>
                    <div class="info">Item Sold 1230</div>
                </div>
            </div>
        </div> --}}
    </div>
    <!-- end page title -->

    <div class="row">
        {{-- <div class="col-xl-3 col-sm-6">
            <div class="card mini-stat bg-primary">
                <div class="card-body mini-stat-img">
                    <div class="mini-stat-icon">
                        <i class="mdi mdi-account-cog-outline float-end"></i>
                    </div>
                    <div class="text-white">
                        <h6 class="text-uppercase mb-3 font-size-16 text-white">Admin</h6>
                        <h2 class="mb-4 text-white">{{ $admin }}</h2>
                        <span class="badge bg-info"> {{ substr($percantageAdmin[0]->progres, 0, 4) }}% </span> <span
                            class="ms-2">Admin register this month</span>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- <div class="col-xl-3 col-sm-6">
            <div class="card mini-stat bg-primary">
                <div class="card-body mini-stat-img">
                    <div class="mini-stat-icon">
                        <i class="mdi mdi-account-cowboy-hat float-end"></i>
                    </div>
                    <div class="text-white">
                        <h6 class="text-uppercase mb-3 font-size-16 text-white">Super Admin</h6>
                        <h2 class="mb-4 text-white">{{ $supadmin }}</h2>
                        <span class="badge bg-danger"> {{ substr($percantageUser[0]->progres, 0, 4) }}% </span> <span
                            class="ms-2">Super Admin register this month</span>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- <div class="col-xl-3 col-sm-6">
            <div class="card mini-stat bg-primary">
                <div class="card-body mini-stat-img">
                    <div class="mini-stat-icon">
                        <i class="mdi mdi-account-tie float-end"></i>
                    </div>
                    <div class="text-white">
                        <h6 class="text-uppercase mb-3 font-size-16 text-white">Users</h6>
                        <h2 class="mb-4 text-white">{{ $users }}</h2>
                        <span class="badge bg-warning"> {{ substr($percantageSuAdmin[0]->progres, 0, 4) }}% </span> <span
                            class="ms-2">Users register this month</span>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- <div class="col-xl-3 col-sm-6">
            <div class="card mini-stat bg-primary">
                <div class="card-body mini-stat-img">
                    <div class="mini-stat-icon">
                        <i class="mdi mdi-account-group float-end"></i>
                    </div>
                    <div class="text-white">
                        <h6 class="text-uppercase mb-3 font-size-16 text-white">All Users</h6>
                        <h2 class="mb-4 text-white">{{ $allusers }}</h2>
                        <span class="badge bg-info"> {{ substr($percantageAllUser[0]->progres, 0, 4) }}% </span> <span
                            class="ms-2">All Users register this month</span>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <!-- end row -->
@endsection
