@extends('layouts.mainBE')
@section('css')
    <style type="text/css">
        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .hidden {
            display: none;
        }

        .simpan {
            display: none;
        }
    </style>
@stop
@section('isi')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">

                    <h4 class="page-title">Dashboard Super Admin</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('pesan'))
                            <div class="col-sm-12">
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    <strong>Success - </strong> {{ session('pesan') }}!
                                </div>
                            @elseif (session('hapus'))
                                <div class="col-sm-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ session('hapus') }}</strong>.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">×</span></button>
                                    </div>
                                </div>
                            @elseif(count($errors) > 0)
                                <div class="col-sm-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>
                                            @foreach ($errors->all() as $error)
                                                {{ $error }}
                                            @endforeach
                                        </strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">×</span></button>
                                    </div>
                                </div>
                        @endif
                        <h4 class="header-title mt-1 mb-3">Halo</h4>
                        {{-- <div class="card-header">Dashboard</div>
                        <div class="card-body">
                            You are Siswa.
                        </div> --}}

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

        </div>
        <!-- end row -->

    </div>
@stop
@section('js')
    <script type="text/javascript"></script>
@stop
