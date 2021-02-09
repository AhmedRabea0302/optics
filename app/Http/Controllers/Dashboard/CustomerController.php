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
            'english_name' => 'required',
            'local_name' => 'required',
            'birth_date' => 'required',
            'national_id' => 'required',
            'address' => 'required',
            'mobile_number' => 'required',
            'email' => 'required',
            'office_number' => 'required',

        ];

        $messages = [
            'english_name.required' => 'Please enter the last name',
            'local_name.required' => 'Please enter the local name',
            'birth_date.required'  => 'Please enter the birth date',
            'national_id.required' => 'Please enter the national id ',
            'address.required' => 'Please enter the address',
            'mobile_number.required' => 'Please enter the mobile number',
            'email.required' => 'Please enter the email',
            'office_number.required' => 'Please enter the office number',
        ];


        $request->validate($rules, $messages);

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
        if($request->points) {
            $customer->moftah_club = 1;
        }
        $customer->save();

        session()->flash('success', 'Customer Added Successfully!');
        return redirect()->route('dashboard.get-all-users');
    }
}
