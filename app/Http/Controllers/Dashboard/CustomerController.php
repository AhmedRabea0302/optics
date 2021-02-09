<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
class CustomerController extends Controller
{
    public function index() {

    }

    public function getAddCustomer(Request $request) {
        $customer_count = Customer::count();
        $customerID = mt_rand(10000000,99999999) . $customer_count;
        return view('dashboard.pages.customers.create_customer', compact('customerID'));
    }

    public function postAddCustomer(Request $request) {

        $rules = [
            'customer_id' => 'required',
            'last_name' => 'required',
            'english_name' => 'required',
            'local_name' => 'required',
            'birth_date' => 'required',
            'national_id' => 'required',
            'age' => 'required',
            'address' => 'required',
            'notes' => 'required',
            'dial_code' => 'required',
            'mobile_number' => 'required',
            'email' => 'required',
            'receive_nots' => 'required',
            'office_number' => 'required',

        ];


        $request->validate($rules);

        $customer = new Customer();
        $customer->customer_id = $request->customer_id;
        $customer->title = $request->title;
        $customer->english_name = $request->english_name;
        $customer->local_name = $request->local_name;
        $customer->gender = $request->gender;
        $customer->birth_date = $request->birth_date;
        $customer->prefered_language = $request->prefered_language;
        $customer->nationality = $request->nationality;
        $customer->national_id = $request->national_id;
        $customer->age = $request->age;
        $customer->country = $request->country;
        $customer->city = $request->city;
        $customer->address = $request->address;
        $customer->dial_code = $request->dial_code;
        $customer->email = $request->email;
        $customer->receive_notifications = $request->receive_nots;
        $customer->office_number = $request->office_number;
        $customer->notes = $request->notes;
        $customer->mobile_number = $request->mobile_number;
        $customer->moftah_club = $request->points;
        $customer->save();

        session()->flash('success', 'Customer Added Successfully!');
        return redirect()->route('dashboard.get-all-users');
    }
}
