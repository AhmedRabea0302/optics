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
    public function index(Request $request)
    {
        $products = Product::when($request->search, function ($query) use ($request) {
            return $query->where('product_id', 'like', '%' . $request->search . '%')
                ->orWhere('describtion', 'like', '%' . $request->search . '%');
        })->latest()->paginate(3);
        return view('dashboard.pages.products.index', compact('products'));
    }

    public function getAddProduct()
    {
        $product_count = Product::count();
        $productID = mt_rand(10000000, 99999999) . $product_count;
        $branches = Branch::all();
        $categories = Category::all();
        $brands = Brand::all();
        $models = glassModel::all();
        return view('dashboard.pages.products.create', compact(['productID', 'branches', 'categories', 'brands', 'models']));
    }

    public function postAddProduct(Request $request)
    {
        $product = new Product();

        $rules = [
            'description' => 'required',
            'price' => 'required',
            'tax' => 'required',
            'color' => 'required',
            'size' => 'required',
        ];

        $messages = [
            'description.required' => 'Please enter product description',
            'price.required' => 'Please enter product Price',
            'tax.required' => 'Please enter product Tax',
            'color.required' => 'Please enter product Color',
            'size.required' => 'Please enter product Size',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $request->validate($rules, $messages);

        $product->product_id = $request->product_id;
        $product->describtion = $request->description;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $product->model_id = $request->model;
        $product->color = $request->color;
        $product->size = $request->size;
        $product->branch_id = $request->branch;
        $product->price = $request->price;
        $product->tax = $request->tax;
        $product->total = $request->tax + $request->price;

        if ($request->amount) {
            $product->amount = $request->amount;
        }

        $product->save();

        session()->flash('success', 'Product Added Successfully!');
        return redirect()->route('dashboard.get-all-products');
    }

    public function getProductDetails(Request $request)
    {
        $product_id = $request->product_id;

        $product = Product::leftJoin('branches', 'branches.id', 'products.branch_id')->where('product_id', $product_id)->select(['products.*', 'branches.branch_name'])->get();

        return response()->json(['product' => $product]);

    }
}
