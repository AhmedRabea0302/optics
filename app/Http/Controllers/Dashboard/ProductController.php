<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Branch;
use App\Brand;
use App\glassModel;
use App\Product;
use Validator;

class ProductController extends Controller
{
    public function index(Request $request) {
        $products = Product::when($request->search, function($query) use ($request) {
            return $query->where('product_id', 'like', '%' . $request->search . '%')
            ->orWhere('describtion', 'like', '%' . $request->search . '%');
        })->latest()->paginate(3);
        return view('dashboard.pages.products.index', compact('products'));
    }

    public function getAddProduct(){
        $product_count = Product::count();
        $productID = mt_rand(10000000, 99999999) . $product_count;
        $branches = Branch::all();
        $categories = Category::all();
        $brands = Brand::all();
        $models = glassModel::all();
        return view('dashboard.pages.products.create', compact(['productID', 'branches', 'categories', 'brands', 'models']));
    }

    public function postAddProduct(Request $request) {
        $product = new Product();

        $rules = [
            'description' => 'required',
            'price' => 'required',
            'tax' => 'required',
        ];

        $messages = [
            'description.required' => 'Please enter product description',
            'price.required' => 'Please enter product Price',
            'tax.required' => 'Please enter product Tax',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $request->validate($rules, $messages);
        
        $product->product_id  = $request->product_id;
        $product->describtion = $request->description;
        $product->category_id = $request->category;
        $product->brand_id    = $request->brand;
        $product->model_id    = $request->model;
        $product->branch_id = $request->branch;
        $product->price = $request->price;
        $product->tax = $request->tax;
        $product->total = $request->tax + $request->price; 

        if($request->amount) {
            $product->amount = $request->amount;
        }

        $product->save();

        session()->flash('success', 'Product Added Successfully!');
        return redirect()->route('dashboard.get-all-products');
    }
}
