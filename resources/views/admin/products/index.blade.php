@extends('admin.layouts.master')

@section('title', 'Products List')


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
                    <li class="breadcrumb-item active">Products List</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('content')
<div class="container-fluid">

    {{-- Filter --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-title">
                <h4 class="m-0 font-weight-bold text-primary">FILTER</h4>
            </div>
            <div class="card-tools">
                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Brand</label>
                        <select name="brand_filter" id="brand_filter" class="form-control select2"
                            onselect="alert('waw')">
                            <option value="">-- Select --</option>
                            @foreach ($brands as $b)
                            <option value="{{$b->id}}">{{$b->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Start Price</label>
                        <input type="number" name="start_price" id="start_price" class="form-control money"
                            placeholder="Rp." min="0">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Category</label>
                        <select name="category_filter" id="category_filter" class="form-control select2">
                            <option value="">-- Select --</option>
                            @foreach ($categories as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">End Price</label>
                        <input type="number" name="end_price" id="end_price" class="form-control money"
                            placeholder="Rp." min="0">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-4">
                    <label for="">Stock</label>
                    <select name="stock_filter" class="form-control select2" id="stock_filter">
                        <option value="">-- Select --</option>
                        <option value="in_stock">In Stock</option>
                        <option value="limited">Limited</option>
                        <option value="out_of_stock">Out of Stock</option>
                    </select>
                </div>
                <div class="col-6 mb-4">
                    <label for="">Price</label>
                    <select name="price_filter" class="form-control select2" id="price_filter">
                        <option value="">-- Select --</option>
                        <option value="high_to_low">Highest to Lowest</option>
                        <option value="low_to_high">Lowest to Highest</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="button" onClick="submit()">Filter</button>
                <button class="btn btn-light" type="button" onClick="reset()">Reset</button>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-title">
                <h4 class="m-0 font-weight-bold text-primary"><strong>Products List</strong></h4>
            </div>
            <div class="card-tools">
                <a href="{{route("admin.product.create")}}" class="btn btn-primary btn-md"><i
                        class="fa fa-plus-circle"></i> Add Product</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table-product" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Barcode</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>
    var table = null;

        (function(){
            loadTable();
            $('.select2').select2();
        })();

        function loadTable() {
            table = $('#table-product').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url : '{{route("admin.product.data")}}',
                    method: 'GET',
                    data: function(value) {
                        value.brand_id = $('#brand_filter').val();
                        value.category_id = $('#category_filter').val();
                        value.start_price = $('#start_price').val();
                        value.end_price = $('#end_price').val();
                        value.stock = $('#stock_filter').val();
                        value.price = $('#price_filter').val();
                    },
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'no', sorting: false},
                    { data: 'id', name: 'id'},
                    { data: 'name', name: 'name'},
                    { data: 'brand_id', name: 'brand'},
                    { data: 'category_id', name: 'category'},
                    { data: 'price', name: 'price'},
                    { data: 'stock', name: 'stock', render: function(data){
                        if(data >= 10){
                            return '<span class="badge badge-success">' + data + '</span>'
                        }else if(data > 0 && data < 10){
                            return '<span class="badge badge-warning">' + data + '</span>'
                        }else if(data == 0) {
                            return '<span class="badge badge-danger">' + data + '</span>'
                        }
                    }},
                    { data: 'barcode', name: 'barcode', sorting: false, render: function(data) {
                        return 'waw'
                    }},
                    { data: 'id', name: 'id', render: function(data){
                        let url = '{{url("/admin/product")}}'
                        return '<div class="btn-group">' +
                        '<a class="btn btn-sm btn-info" href="' + url +'/view/' + data +'"><i class="fas fa-eye" style="color: white"></i></a>' +
                        '<a class="btn btn-sm btn-warning" href="' + url +'/edit/' + data +'"><i class="fas fa-edit" style="color: white"></i></a>' +
                        '<a class="btn btn-sm btn-danger delete" href="#" onClick="deleteConfirm(' + data + ')"><i class="fas fa-trash" style="color: white"></i></a>' +
                        '</div>';

                    }}
                ]
            });
        }

        function drawTable(){
            table.draw();
        }

        function submit() {
            drawTable();
        }

        function reset() {
            $('#brand_filter').val("").change();
            $('#category_filter').val("").change();
            $('#start_price').val("");
            $('#end_price').val("");
            $('#stock_filter').val("").change();
            $('#price_filter').val("").change();
        }
        

        function deleteConfirm(id) {
            Swal.fire({
                    title: 'Are you sure?',
                    text: "Are you sure want to delete this product ?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((result) => {
                    if (result.value) {
                        window.location ="/admin/product/delete/"+id ;
                    }
                })
        }

</script>
<script>
    @if($errors->any())
            $('#myModal').modal('show');
        @endif
</script>
@endsection