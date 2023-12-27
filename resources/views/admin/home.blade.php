@extends('admin.layout.app')


@section('app')
    <section class="section">
        <div class="section-header">
            <h1>{{ $name }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">{{ $name }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row mb-2">
                <div class="col-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="far fa-clock"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Data Actual</h4>
                            </div>
                            <div class="card-body">
                                Data Actual Bulan {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="far fa-building"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Departemen</h4>
                            </div>
                            <div class="card-body">
                                {{ \App\Models\Departemen::count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total User</h4>
                            </div>
                            <div class="card-body">
                                {{ \App\Models\User::count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-envelope"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>SOP</h4>
                            </div>
                            <div class="card-body">
                                {{ \App\Models\SOP::whereMonth('created_at', date('m'))->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-envelope"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>JSA</h4>
                            </div>
                            <div class="card-body">
                                {{ \App\Models\JSA::whereMonth('created_at', date('m'))->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-envelope"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Interaksi Kerja</h4>
                            </div>
                            <div class="card-body">
                                {{ \App\Models\InteraksiKerja::whereMonth('created_at', date('m'))->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-envelope"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Formulir</h4>
                            </div>
                            <div class="card-body">
                                {{ \App\Models\Formulir::whereMonth('created_at', date('m'))->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-envelope"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>IBPR</h4>
                            </div>
                            <div class="card-body">
                                {{ \App\Models\IBPR::whereMonth('created_at', date('m'))->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
