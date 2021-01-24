@extends('admin.layouts.master')

@section('title', 'Product Detail')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Product Detail</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route("admin.dashboard")}}">Admin</a></li>
                    <li class="breadcrumb-item active"><a href="{{route("admin.product")}}">Products List</a></li>
                    <li class="breadcrumb-item active">Product Detail</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection


@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-title">
                <h4 class="m-0 font-weight-bold text-primary"> {{ $product->name }} </h4>
            </div>
            <div class="card-tools">
                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="image_slider">
                        @foreach ($product_image as $item)
                        <img src="{{$item->image_url}}" width="100" height="100">
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>
    $(document).ready(function{
        
    });
</script>
@endsection