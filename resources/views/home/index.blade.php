@extends('layouts.app-master')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@endsection

@section('content')
    <div class="row d-none">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">You are logged in!</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Surat Masuk</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div id="pie-sm" style="height: 220px;"></div>    
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-4">
                            <div class="description-block border-right">
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 35%</span>
                            <h5 class="description-header">105</h5>
                            <span class="description-text">Surat Baru</span>
                            </div>

                        </div>

                        <div class="col-4">
                            <div class="description-block border-right">
                            <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 42%</span>
                            <h5 class="description-header">129</h5>
                            <span class="description-text">Disposisi</span>
                            </div>

                        </div>

                        <div class="col-4">
                            <div class="description-block">
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 23%</span>
                            <h5 class="description-header">73</h5>
                            <span class="description-text">Proses</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Surat Keluar</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div id="pie-sk" style="height: 220px;"></div>    
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-4">
                            <div class="description-block border-right">
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 13%</span>
                            <h5 class="description-header">32</h5>
                            <span class="description-text">Draft Surat</span>
                            </div>

                        </div>

                        <div class="col-4">
                            <div class="description-block border-right">
                            <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 44%</span>
                            <h5 class="description-header">103</h5>
                            <span class="description-text">Paraf/Tanda Tangan</span>
                            </div>

                        </div>

                        <div class="col-4">
                            <div class="description-block">
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 43%</span>
                            <h5 class="description-header">102</h5>
                            <span class="description-text">Shared</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Surat Masuk</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div id="bar-jumlah-smsk-pbln" style="height: 210px;"></div>    
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Statistik Surat</h3>
                    </div>
                </div>
                <div class="card-body" style="height: 250px;">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item active">
                            <a href="#" class="nav-link">
                                <i class="fas fa-inbox"></i><span class="ml-2">Arsip Surat Masuk</span>
                                <span class="badge bg-success float-right">12</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-envelope"></i><span class="ml-2">Arsip Surat Keluar</span>
                                <span class="badge bg-success float-right">12</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="far fa-file-alt"></i><span class="ml-2">Disposisi Selesai</span>
                                <span class="badge bg-primary float-right">12</span>
                        </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="fas fa-filter"></i><span class="ml-2">Disposisi Proses</span>
                            <span class="badge bg-info float-right">12</span>
                        </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="far fa-trash-alt"></i><span class="ml-2">Disposisi Proses > 7 hari</span>
                                <span class="badge bg-danger float-right">12</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop



@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/plugins/highcharts/highcharts.js') }}"></script>
    <script type="text/javascript" src="/assets/app/home/index.js"></script>
@endsection
