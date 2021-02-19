<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Validator;

class CategoryController extends Controller
{
    public function index(Request $request) {
        $categories = Category::when($request->search, function($query) use ($request) {
            return $query->where('category_name', 'like', '%' . $request->search . '%');
        })->latest()->paginate(3);
        return view('dashboard.pages.categories.index', compact('categories'));
    }

    public function addCategory(Request $request) {
        $categorie = new Category();

        $rules = [
            'category_name' => 'required|unique:categories',
        ];

        $messages = [
            'category_name.required' => 'Please enter category name',
            'category_name.unique' => 'This Category Added Before',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return response()->json(['message' => 'This Categoery Added Before!']);
        }

        $categorie->category_name = $request->category_name;
        $categorie->save();

    }

    public function updateCategory(Request $request) {
        $categorie = Category::find($request->id);

        $rules = [
            'category_name' => 'required|unique:categories',
        ];

        $messages = [
            'category_name.required' => 'Please enter category name',
            'category_name.unique' => 'This Category Added Before',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return response()->json(['message' => 'This Categoery Added Before!']);
        }

        $categorie->category_name = $request->category_name;
        $categorie->save();

    }
}
