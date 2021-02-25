<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Branch;

class StockOverview extends Controller
{
    public function index() {
        return view('dashboard.pages.stock.index');
    }

    public function searchItem(Request $request) {
        $product = Product::where('product_id', $request->product_id)->first();
        if($product) {
            $branch_name = Branch::select('branch_name')->where('id', $product->branch_id)->first();
            $product['branch_name'] = $branch_name;
            return response()->json($product);
        } else {
            return response()->json(['message' => 'No Item Found With this ID!']);
        }
    }
}
