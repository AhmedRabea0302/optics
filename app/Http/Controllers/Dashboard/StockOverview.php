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

        $cat_id = $request->category_id;
        $brand_id = $request->brand_id;
        $model_id = $request->model_id;
        $size = $request->size;
        $color = $request->color; 

        $query = 'SELECT * From products WHERE(' 
        . ( $cat_id ? 'category_id = :category_id' : '' ) 
        . ( $brand_id ? ' AND brand_id = :brand_id' : '') 
        . ( $model_id ? ' AND model_id = :model_id' : '') 
        . ( $size ? ' AND size = :size' : '')
        . ( $color ? ' AND color = :color' : '') . ')';
        
        $parmetersArray = Array( 
            'category_id' => $cat_id,
            (!$brand_id) ? NULL : 'brand_id' => $brand_id,
            (!$model_id) ? NULL : 'model_id' => $model_id,
            (!$color) ? NULL : 'color' => $color,
            (!$size) ? NULL : 'size' => $size
        );

        $this->removeEmptyValues($parmetersArray);
        $products = DB::select($query, $parmetersArray);

        foreach ($products as $product) {
            $branch_name = Branch::select('branch_name')->where('id', $product->branch_id)->first();
            $product->branch_name = $branch_name;
        }

        return response()->json($products);
    }

    // To Remove ements with Empy Values from an array
    function removeEmptyValues(array &$array)
    {
        foreach ($array as $key => &$value) {
            if (is_array($value)) {
                $value = removeEmptyValues($value);
            }
            if (empty($value)) {
                unset($array[$key]);
            }
        }
        return $array;
    }
}
