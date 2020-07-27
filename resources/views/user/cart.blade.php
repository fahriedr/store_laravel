@extends('user.layouts.master')

@section('content')

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                <li class="breadcrumb-item active">Shopping Cart</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Shopping Cart</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-centered mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                    <th style="width: 50px;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(session('cart'))
                                                <?php $totalharga = 0; ?>
                                                @foreach (session('cart') as $key => $detail)
                                                <?php $total = $detail['product_price'] * $detail['quantity']; ?>
                                                <tr>
                                                    <td>
                                                        <img src="{{asset('backend/images/products_image/'.$detail['product_pict'])}}"
                                                            alt="contact-img" class="rounded mr-3" height="48">
                                                        <p class="m-0 d-inline-block align-middle font-16">
                                                            <a href="/product/detail/{{$detail['product_id']}}"
                                                                class="text-reset font-family-secondary">{{$detail['product_name']}}</a>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        Rp.{{number_format($detail['product_price'])}}
                                                    </td>
                                                    <td>
                                                        <div class="custom-quantity-input">
                                                            <a href="/cart/minus/{{$detail['product_id']}}"
                                                                class="action-icon quantity-input-down">
                                                                <i class="mdi mdi-minus-circle mr-2"></i>
                                                            </a>
                                                            <input name="qty" type="number" min="1"
                                                                value="{{$detail['quantity']}}"
                                                                class="form-control d-inline-block mr-2"
                                                                placeholder="Qty" style="width: 90px;">
                                                            <a href="/cart/plus/{{$detail['product_id']}}"
                                                                class="action-icon quantity-input-up">
                                                                <i class="mdi mdi-plus-circle"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        Rp.{{number_format($total)}}
                                                    </td>
                                                    <td>
                                                        <a href="/cart/delete/{{$detail['product_id']}}"
                                                            class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>
                                                <?php $totalharga+=$total; ?>
                                                @endforeach
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3"><b>Total</b></td>
                                                    <td><b>
                                                            <h3>Rp. {{number_format($totalharga)}}</h3>
                                                        </b></td>
                                                </tr>
                                            </tfoot>
                                            @else
                                            <tr>
                                                <td colspan="4">
                                                    <center>Cart is empty</center>
                                                </td>
                                            </tr>
                                            @endif
                                            </tbody>

                                        </table>
                                    </div> <!-- end table-responsive-->

                                    <!-- Add note input-->
                                    <div class="mt-3">
                                        <label for="example-textarea">Add a Note:</label>
                                        <textarea class="form-control" id="example-textarea" rows="3"
                                            placeholder="Write some note.."></textarea>
                                    </div>

                                    <!-- action buttons-->
                                    <div class="row mt-4">
                                        <div class="col-sm-6">
                                            <a href="ecommerce-products.html"
                                                class="btn text-muted d-none d-sm-inline-block btn-link font-weight-semibold">
                                                <i class="mdi mdi-arrow-left"></i> Continue Shopping </a>
                                        </div> <!-- end col -->
                                        <div class="col-sm-6">
                                            <div class="text-sm-right">
                                                <a href="ecommerce-checkout.html" class="btn btn-danger"><i
                                                        class="mdi mdi-cart-plus mr-1"></i> Checkout </a>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->
                                </div>
                                <!-- end col -->

                                {{-- <div class="col-lg-4">
                                    <div class="border p-3 mt-4 mt-lg-0 rounded">
                                        <h4 class="header-title mb-3">Order Summary</h4>

                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>Grand Total :</td>
                                                        <td>$1571.19</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Discount : </td>
                                                        <td>-$157.11</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping Charge :</td>
                                                        <td>$25</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Estimated Tax : </td>
                                                        <td>$19.22</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total :</th>
                                                        <th>$1458.3</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>

                                    <div class="alert alert-warning mt-3" role="alert">
                                        Use coupon code <strong>UBTF25</strong> and get 25% discount !
                                    </div>

                                    <div class="input-group mt-3">
                                        <input type="text" class="form-control form-control-light"
                                            placeholder="Coupon code" aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-light" type="button">Apply</button>
                                        </div>
                                    </div>

                                </div> <!-- end col --> --}}

                            </div> <!-- end row -->
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
</div>
@endsection

@section('footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    //     $(function(){
//   $(".quantity-input-up").click(function(){
//     var inpt = $(this).parents(".custom-quantity-input").find("[name=qty]");
//     var val = parseInt(inpt.val());
//     if ( val < 0 ) inpt.val(val=0);
//     inpt.val(val+1);
//   });
//   $(".quantity-input-down").click(function(){
//     var inpt = $(this).parents(".custom-quantity-input").find("[name=qty]");
//     var val = parseInt(inpt.val());
//     if ( val < 0 ) inpt.val(val=0);
//     if ( val == 0 ) return;
//     inpt.val(val-1);
//   });
// });
</script>
<script>
    @if (Session::has('Success'))
        Swal.fire(
            'Success!',
            "{{Session::get('Success')}}",
            'success'
        )
    @elseif (Session::has('Error'))
        Swal.fire({
            title: "Error!",
            text: "{{Session::get('Error')}}",
            type: "error",
            button: "Close!",
        });
    @endif
</script>
@endsection