<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brands;

class BrandsController extends Controller
{

    public function stringGenerator($length)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghizklmnopqrstuvwxyz';
        $charLength = strlen($characters);
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $result .= $characters[rand(0, $charLength - 1)];
        }

        return $result;
    }

    public function codeGenerator()
    {
        $status = true;
        while ($status) {
            $brand_code = $this->stringGenerator(10);
            $check_code = Brands::where('code', $brand_code)->first();

            $status = $check_code != null ? true : false;
            return $brand_code;
        }
    }

    public function index()
    {
        $brands = Brands::all();
        return view('admin.brands.index', compact('brands'));
    }

    public function create(Request $request)
    {
        $name = ucfirst($request->name);
        $code = $this->codeGenerator();

        if (Brands::where('name', $name)->exists()) {
            return redirect('/admin/brand')->with('Error', 'Brand already exists');
        }

        $brand = new Brands();
        $brand->name = $name;
        $brand->code = $code;
        $brand->save();

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $extension = $request->file('logo')->getClientOriginalExtension();
            $logo_name = time() . "-" . $code . "-logo" . "." . $extension;
            $logo->move('assets/img/brands_logo/', $logo_name);
            $brand->logo = $logo_name;
            $brand->save();
        }

        return redirect('/admin/brand')->with('Success', 'Brand has been added');
    }

    public function edit($id)
    {
        $brand = Brands::find($id);

        return view('admin.brands.edit', ['brand' => $brand]);
    }

    public function update(Request $request, $id)
    {
        $brand = Brands::find($id);
        $name = ucfirst($request->name);
        $brand_code = strtolower($request->name);
        $request->request->add(['brand_code' => $brand_code, 'name' => $name]);
        // dd($request->all());
        $brand->update($request->all());
        if ($request->hasFile('brand_logo')) {
            $logo = $request->file('brand_logo');
            $extension = $request->file('brand_logo')->getClientOriginalExtension();
            $logo_name = time() . "-" . $brand_code . "-logo" . "." . $extension;
            $logo->move('backend/images/products-logo/', $logo_name);
            $brand->brand_logo = $logo_name;
            $brand->save();
        }
        return redirect('/admin/brands')->with('Success', 'Brand has been updated');
    }

    public function delete($id)
    {
        $brand = Brands::find($id);
        if ($brand->products()->where('brand_id', $id)->exists()) {
            return redirect('/admin/brands')->with('Error', 'Sorry, you can\'t delete this brand');
        }
        $brand->delete();

        return redirect('/admin/brands')->with('Success', 'Brand has been Deleted');
    }

    public function data(Request $request)
    {
        $data = Brands::select('id', 'name')->get();

        return response()->json(['data' => $data], 200);
    }
}
