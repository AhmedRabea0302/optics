<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Branch;
use App\Category;
use App\glassModel;
use App\Brand;
use DB;

class StockOverview extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $models = glassModel::all();

        return view('dashboard.pages.stock.index', compact(['categories', 'brands', 'models']));
    }

    public function searchItem(Request $request)
    {
        $product = Product::where('product_id', $request->product_id)->first();
        if ($product) {
            $branch_name = Branch::select('branch_name')->where('id', $product->branch_id)->first();
            $product['branch_name'] = $branch_name;
            return response()->json($product);
        } else {
            return response()->json(['message' => 'No Item Found With this ID!']);
        }
    }

    // Filter Products By Category ID
    public function filterByCatId(Request $request)
    {
        $products = Product::where('category_id', $request->category_id)->get();

        if ($products) {
            return response()->json($products);
        }
    }

    // Filter Products By Brand ID
    public function filterByBrandId(Request $request)
    {
        $products = Product::where('brand_id', $request->brand_id)->get();

        if ($products) {
            return response()->json($products);
        }
    }

    // Filter Products By Model ID
    public function filterByModelId(Request $request)
    {
        $products = Product::where('model_id', $request->model_id)->get();

        if ($products) {
            return response()->json($products);
        }
    }


    // Filter Products By Size
    public function filterBySize(Request $request)
    {
        $products = Product::where('size', $request->size)->get();

        if ($products) {
            return response()->json($products);
        }
    }

    // Filter Products By Color
    public function filterByColor(Request $request)
    {
        $products = Product::where('color', $request->color)->get();

        if ($products) {
            return response()->json($products);
        }
    }


    // Filter Products By Category And Brand
    // public function filterProductsByCategoryAndBrand(Request $request) {
    //     $products = Product::where(['category_id' => $request->category_id, 'brand_id' => $request->brand_id])->get();

    //     if($products) {
    //         return response()->json($products);
    //     }
    // }


    // Filter Brands by Category ID
    public function filterBrandsByCatId(Request $request)
    {
        $brands = Brand::where('category_id', $request->category_id)->get();

        if ($brands) {
            return response()->json($brands);
        }
    }

    // Filter Models  by Brand ID
    public function filterModelsByBrandId(Request $request)
    {
        $models = glassModel::where('brand_id', $request->brand_id)->get();

        if ($models) {
            return response()->json($models);
        }
    }

    // Filter Models By Category_id AND BrandId
    public function filterModelsByCategoryIdAndBrandId(Request $request)
    {
        if ($request->brand_id) {
            $models = glassModel::where([['category_id', '=', $request->category_id],
                ['brand_id', '=', $request->brand_id]])->get();
        } else {
            $models = glassModel::where('category_id', $request->category_id)->get();
        }

        if ($models) {
            return response()->json($models);
        }
    }


    public function fullSearch(Request $request)
    {
//        $products = DB::select('select * from products where (category_id = :category_id AND brand_id = :brand_id AND model_id = :model_id)',
//        ['category_id' => $request->category_id, 'brand_id' => $request->brand_id, 'model_id' => $request->model_id]);
//
        $category_id = $request->category_id;
        $model_id = $request->model_id;
        $brand_id = $request->brand_id;
        $size_id = $request->size_id;
        $color_id = $request->color_id;

//        $products = Product::where(function ($q) use ($category_id, $brand_id, $model_id) {
//            $q->where('scategory_id', $category_id);
//            $q->where('brand_id', $brand_id);
//            $q->where('model_id', $model_id);
//        })->orwhere(function ($q) use ($category_id, $brand_id) {
//            $q->where('category_id', $category_id);
//            $q->where('brand_id', $brand_id);
//        })->orwhere(function ($q) use ($category_id, $model_id) {
//            $q->where('category_id', $category_id);
//            $q->where('model_id', $model_id);
//        })->get();
//        $products = '';
//        if ($category_id && $brand_id)
//            $products = Product::where('category_id', $category_id)->where('brand_id', $brand_id)->get();
//
//        if ($category_id && $model_id)
//            $products = Product::where('category_id', $category_id)->where('model_id', $model_id)->get();
//
//        if ($category_id && $size_id)
//            $products = Product::where('category_id', $category_id)->where('size_id', $size_id)->get();
//
//        if ($category_id && $color_id)
//            $products = Product::where('category_id', $category_id)->where('color_id', $color_id)->get();
//
//        if ($category_id && $brand_id && $model_id && $size_id && $color_id)
//            $products = Product::where('category_id', $category_id)->where('brand_id', $brand_id)->where('model_id', $model_id)->where('size_id', $size_id)->where('color_id', $color_id)->get();
//
//        if ($category_id && $brand_id && $model_id && $size_id)
//            $products = Product::where('category_id', $category_id)->where('brand_id', $brand_id)->where('model_id', $model_id)->where('size_id', $size_id)->get();
//
//        if ($category_id && $brand_id && $model_id)
//            $products = Product::where('category_id', $category_id)->where('brand_id', $brand_id)->where('model_id', $model_id)->get();
//
//        if ($category_id && $brand_id && $size_id)
//            $products = Product::where('category_id', $category_id)->where('brand_id', $brand_id)->where('size_id', $size_id)->get();
//
//        if ($category_id && $brand_id && $color_id)
//            $products = Product::where('category_id', $category_id)->where('brand_id', $brand_id)->where('color_id', $color_id)->get();
//
//        if ($category_id && $model_id && $color_id)
//            $products = Product::where('category_id', $category_id)->where('model_id', $model_id)->where('color_id', $color_id)->get();
//
//        if ($category_id && $model_id && $size_id)
//            $products = Product::where('category_id', $category_id)->where('model_id', $model_id)->where('size_id', $size_id)->get();
//
//        if ($category_id && $color_id && $size_id)
//            $products = Product::where('category_id', $category_id)->where('color_id', $color_id)->where('size_id', $size_id)->get();

        $products = Product::where('category_id', $category_id);

        if (isset($brand_id))
            $products = $products->where('brand_id', $brand_id);

        if (isset($model_id))
            $products = $products->where('model_id', $model_id);

        if (isset($size_id))
            $products = $products->where('size_id', $size_id);

        if (isset($color_id))
            $products = $products->where('color_id', $color_id);

        $products = $products->get();

        return response()->json($products);
    }
}
