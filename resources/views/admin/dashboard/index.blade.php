@extends('admin.layouts.master')

@section('title')
    Dashboard
@endsection

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blank Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <!-- Content Row -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
        
                    <div class="info-box-content">
                        <span class="info-box-text">Total Product</span>
                        <span class="info-box-number">
                            {{count($products)}}
                        </span>
                    </div>
                    </div>
                </div>
        
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
        
                    <div class="info-box-content">
                        <span class="info-box-text">Total Brands</span>
                        <span class="info-box-number">
                            {{$brands->count()}}
                        </span>
                    </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
        
                    <div class="info-box-content">
                        <span class="info-box-text">Total Product</span>
                        <span class="info-box-number">
                            {{count($products)}}
                        </span>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection