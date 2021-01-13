<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Brands;
use App\Models\Categories;
use App\Models\ProductPicture;
use PDF;
use illuminate\Support\Facades\File;
use Milon\Barcode\DNS1D;
use Yajra\DataTables\DataTables;
use Picqer\Barcode\BarcodeGeneratorPNG;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::all();
        $brands = Brands::all();
        $categories = Categories::all();

        return view('admin.products.index', ['products' => $products, 'brands' => $brands, 'categories' => $categories]);
    }


    //Input new product to database
    public function create(Request $request)
    {

        $message = [
            'required' => 'This field is required',
            'mimes' => 'Format foto must be jpeg or png',
            'integer' => 'Value must be numeric'
        ];

        $this->validate($request, [
            'name' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'description' => 'required',
            // 'product_pict' => 'required|mimes:jpg,jpeg,png',
        ], $message);

        $product = new \App\Models\Products;
        $product->name = $request->name;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->save();

        
        // $generator = new BarcodeGeneratorPNG();
        // $barcode = '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($product, $generator::TYPE_CODE_128)) . '" >';
        // $product->update(['barcode' => $barcode]);
        
        
        if($request->hasFile('product_pict')) {
            $product_pict = $request->file('product_pict');
            foreach ($product_pict as $pro_pict) {
                $product_picture = new \App\Models\ProductPicture;
                $request->request->add(['id' => $product->id]);
                $get_name = $pro_pict->getClientOriginalName();
                $pict_name = time() . '-' . $get_name;
                $pro_pict->move('backend/images/products_image/', $pict_name);
                $product_picture->product_pict = $pict_name;
                $product_picture->id = $request->id;
                $product_picture->save();
            }
        }
        

        return redirect('/admin/product')->with('Success', 'Product has been added');
    }

    public function edit($id)
    {
        $product = Products::find($id);
        $brands = Brands::all();
        $categories = Categories::all();


        return view('admin.products.edit', ['product' => $product, 'brands' => $brands, 'categories' => $categories]);
    }

    //Update product to database
    public function update(Request $request, $id)
    {
        $product = Products::find($id);
        $product->update($request->all());
        // dd($request->$pict_name);
        if ($request->hasFile('product_pict')) {
            $pict = $request->file('product_pict');
            $slug = Str::slug($request->name) . "." . $pict->getClientOriginalExtension();
            $pict_name = time() . '-' . $slug;
            $pict->move('backend/images/products_image/', $pict_name);
            $product->product_pict = $pict_name;
            $product->save();
        }

        return redirect('/admin/product')->with('Success', 'Product has been updated');
    }


    //Delete product from database
    public function delete($id)
    {
        $product = Products::find($id);
        $product_picture = ProductPicture::where('id', $id);
        $picture_name = $product_picture->pluck('product_pict');
        // dd($product_picture);
        foreach ($picture_name as $pict_name) {
            $pict_dir = public_path('backend/images/products_image/' . $pict_name);
            if (file_exists($pict_dir)) {
                unlink($pict_dir);
            }
        }

        $product_picture->delete();
        $product->delete();

        return redirect('/admin/product')->with('Success', 'Product has been deleted');
    }

    public function detail($id)
    {
        $product = Products::find($id);
        $product_picture = ProductPicture::where('id', $id);
        $picture_name = $product_picture->pluck('product_pict');
        $pict = public_path() . '/backend/images/products_image/' . $picture_name;
        // dd($picture_name);
        if ($product->stock >= 30) {
            $stock = "Ready Stok";
        } elseif ($product->stock >= 1 && $product->stock < 30) {
            $stock = "Limited";
        } else {
            $stock = "Out of Stock";
        }
        return view('admin.products.detail', ['product' => $product, 'stock' => $stock, 'picture_name' => $picture_name]);
    }

    public function data(Request $request)
    {

        $brand_id = $request->brand_id != null ? $request->brand_id : null;
        $category_id = $request->category_id != null ? $request->category_id : null;
        $start_price = $request->start_price ?? null;
        $end_price = $request->end_price ?? null;
        $stock = $request->stock ?? null;
        $price = $request->price ?? null;
        

        $data = Products::query()
        ->when( isset($brand_id) != null,
            function($q) use ($brand_id){
                $q->where('brand_id', '=', $brand_id);
            }
        )
        ->when( isset($category_id) != null,
            function($q) use ($category_id){
                $q->where('category_id', '=', $category_id);
            }
        )
        ->when( isset($start_price) != null,
            function($q) use ($start_price){
                $q->where('price', '>=', $start_price);
            }
        )
        ->when( isset($end_price) != null,
            function($q) use ($end_price){
                $q->where('price', '<=', $end_price);
            }
        )
        ->when( isset($stock) != null && $stock == 'in_stock',
            function($q) use ($stock){
                $q->where('stock', '>=', 10);
            }
        )
        ->when( isset($stock) != null && $stock == 'limited',
            function($q) use ($stock){
                $q->where([
                    ['products.stock', '>', 0],
                    ['products.stock', '<', 10]
                ]);
            }
        )
        ->when( isset($stock) != null && $stock == 'out_of_stock',
            function($q) use ($stock){
                $q->where('products.stock', '=', 0);
            }
        )
        ->when( isset($price) != null && $price == 'high_to_low', 
            function($q) use ($price){
                $q->orderBy('price', 'desc');
            }
        )
        ->when( isset($price) != null && $price == 'low_to_high', 
            function($q) use ($price){
                $q->orderBy('price', 'asc');
            }
        )
        ->get();

        // return response()->json(['data' => $request->all()], 200);

        return DataTables::of($data)
            ->editColumn( 
                'brand_id',
                function($q) {
                    return $q->brands->brand_name;
                }
            )
            ->editColumn( 
                'category_id',
                function($q) {
                    return $q->categories->category_name;
                }
            )
            ->editColumn(
                'price',
                function($q) {
                    return "Rp." . number_format($q->price);
                }
            )
            ->addIndexColumn()
            ->toJson();
    }

    public function print_pdf()
    {
        $products = Products::all();

        $pdf = PDF::loadview('admin.product.products_pdf', ['products' => $products]);
        return $pdf->download(date("l jS \of F Y h:i:s A ") . 'products-report.pdf');
    }
}
