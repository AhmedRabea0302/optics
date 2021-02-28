<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Brand;
use App\Category;
use Validator;

class BrandController extends Controller
{
    public function index(Request $request) {
        $categories = Category::all();
        $brands = Brand::when($request->search, function($query) use ($request) {
            return $query->where('category_id', 'like', '%' . $request->search . '%')
            ->orWhere('brand_name', 'like', '%' . $request->search . '%');
        })->latest()->paginate(3);
        return view('dashboard.pages.brands.index', compact(['brands', 'categories']));
    }

    public function addBrand(Request $request) {
        $brand = new Brand();

        $rules = [
            'brand_name' => 'required|unique:brands',
        ];

        $messages = [
            'brand_name.required' => 'Please enter brand name',
            'brand_name.unique' => 'This brand Added Before',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return response()->json(['message' => 'This Brand Added Before!']);
        }

        $brand->brand_name = $request->brand_name;
        $brand->category_id = $request->category_id;
        $brand->save();

    }

    public function updateBrand(Request $request) {
        $brand = Brand::find($request->id);

        $rules = [
            'brand_name' => 'required',
        ];

        $messages = [
            'brand_name.required' => 'Please enter Brand name',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return response()->json(['message' => 'This Brand Added Before!']);
        }

        $brand->brand_name = $request->brand_name;
        $brand->save();

    }
}
