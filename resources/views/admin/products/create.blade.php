@extends('admin.layouts.master')

@section('title', 'Create Product')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route("admin.dashboard")}}">Admin</a></li>
                        <li class="breadcrumb-item active"><a href="{{route("admin.product")}}">Products</a></li>
                        <li class="breadcrumb-item active">Add Product</li>
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
            <h6 class="m-0 font-weight-bold text-primary">Create New Product</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form role="form" action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data" id="form">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input name="name" type="text"
                                    class="form-control @if($errors->has('name')) is-invalid @endif" id="name"
                                    placeholder="Name" value="{{old('name')}}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Brand</label>
                                        <select name="brand_id"
                                            class="form-control select2 @if($errors->has('brand_id')) is-invalid @endif">
                                            <option value="">-- Select Brand --</option>
                                            @foreach ($brands as $b)
                                            <option value="{{$b->id}}" @if (old('brand_id')==$b->id) selected
                                                @endif>{{$b->name}} </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('brand_id'))
                                            <span class="text-danger">{{$errors->first('brand_id')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="category_id"
                                            class="form-control select2 @if($errors->has('category_id')) is-invalid @endif">
                                            <option value="">-- Select Category --</option>
                                            @foreach ($categories as $c)
                                            <option value="{{$c->id}}" @if (old('category_id')==$c->id) selected
                                                @endif>{{$c->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('category_id'))
                                            <span class="text-danger">{{$errors->first('category_id')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Price</label>
                                        <input name="price" type="num"
                                            class="form-control @if($errors->has('price')) is-invalid @endif"
                                            placeholder="Rp." value="{{old('price')}}">
                                        @if ($errors->has('price'))
                                            <span class="text-danger">{{$errors->first('price')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Stock</label>
                                        <input name="stock" type="num"
                                            class="form-control @if($errors->has('stock')) is-invalid @endif"
                                            placeholder="Stock" value="{{old('stock')}}">
                                        @if ($errors->has('stock'))
                                        <span class="text-danger">{{$errors->first('stock')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Weight</label>
                                        <input type="number" class="form-control" name="weight">
                                        <span class="text-muted">*In Gram</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Condition</label>
                                        <select name="condition" id="condition" class="form-control">
                                            <option value="">-- Select --</option>
                                            <option value="baru">Baru</option>
                                            <option value="bekas">Bekas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama">Description</label>
                                <textarea name="description" cols="30" rows="20" id="summernote"
                                    class="form-control @if($errors->has('description')) is-invalid @endif">{{old('description')}}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{$errors->first('description')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Pict</label>
                                <input name="product_pict[]" type="file" multiple="multiple" id="exampleInputFile"
                                    class="form-control-file @if($errors->has('product_pict')) parsley-error @endif"
                                    value="{{old('product_pict')}}">
                                @if ($errors->has('product_pict'))
                                <ul class="parsley-errors-list filled" id="parsley-id-7" aria-hidden="false">
                                    <li class="parsley-required">{{$errors->first('product_pict')}}</li>
                                </ul>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
    $(document).ready( function () {
        $('#condition').select({
            theme: 'bootstrap4'
        });
        $('#summernote').summernote();
        $('#datepicker').datepicker({
            autoclose: true,
            format:'yyyy-mm-dd'
        });
    });
</script>
@endsection