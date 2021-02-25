<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Brand;
use App\Category;
use App\glassModel;
use Validator;

class GlassModelController extends Controller
{
    public function index(Request $request) {
        $categories = Category::all();
        $brands = Brand::all();
        $models = glassModel::when($request->search, function($query) use ($request) {
            return $query->where('model_id', 'like', '%' . $request->search . '%');
        })->latest()->paginate(3);
        return view('dashboard.pages.models.index', compact(['models', 'categories', 'brands']));
    }

    public function addModel(Request $request) {
        $model = new glassModel();

        $rules = [
            'model_id' => 'required|unique:glass_models',
        ];

        $messages = [
            'model_id.required' => 'Please enter model ID',
            'model_id.unique' => 'This model Added Before',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return response()->json(['message' => 'This Model Added Before!']);
        }

        $model->category_id = $request->category_id;
        $model->brand_id    = $request->brand_id;
        $model->model_id    = $request->model_id;

        $model->save();

    }

    public function updateModel(Request $request) {
        $model = glassModel::find($request->id);
        $rules = [
            'model_id' => 'required',
        ];

        $messages = [
            'model_id.required' => 'Please enter model ID',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return response()->json(['message' => 'Please enter model ID!']);
        }
        $model->model_id = $request->model_id;
        $model->save();

    }
}
