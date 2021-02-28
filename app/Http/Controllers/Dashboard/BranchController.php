<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch;
use Validator;

class BranchController extends Controller
{
    public function index(Request $request) {
        $branches = Branch::when($request->search, function($query) use ($request) {
            return $query->where('branch_name', 'like', '%' . $request->search . '%');
        })->latest()->paginate(3);
        return view('dashboard.pages.branches.index', compact('branches'));
    }

    public function addBranch(Request $request) {
        $branche = new Branch();

        $rules = [
            'branch_name' => 'required|unique:branches',
        ];

        $messages = [
            'branch_name.required' => 'Please enter branch name',
            'branch_name.unique' => 'This Branch Added Before',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return response()->json(['message' => 'This Branch Added Before!']);
        }
        $branche_count = Branch::count();
        $branche->branch_id = mt_rand(100000,999999) . $branche_count;
        $branche->branch_name = $request->branch_name;
        $branche->save();

    }

    public function updatebranch(Request $request) {
        $branche = branch::find($request->id);

        $rules = [
            'branch_name' => 'required|unique:branches',
        ];

        $messages = [
            'branch_name.required' => 'Please enter branch name',
            'branch_name.unique' => 'This Branch Added Before',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return response()->json(['message' => 'This Branch Added Before!']);
        }

        $branche->branch_name = $request->branch_name;
        $branche->save();

    }
}
