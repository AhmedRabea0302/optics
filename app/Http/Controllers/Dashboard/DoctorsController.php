<?php


namespace App\Http\Controllers\Dashboard;


use App\Customer;
use App\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{

    public function index(Request $request)
    {
        $doctors = Doctor::when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('code', 'like', '%' . $request->search . '%');
        })->latest()->paginate(2);

        return view('dashboard.pages.doctors.all-doctors')->with(compact('doctors'));
    }

    public function getDoctor(Request $request)
    {
        $doctor_count = Doctor::count();
        $DoctorId = mt_rand(10000000, 99999999) . $doctor_count;

        return view('dashboard.pages.doctors.create_doctor')->with(compact('DoctorId'));
    }

    public function addDoctor(Request $request)
    {

        $rules = [
            'name' => 'required',
        ];

        $messages = [
            'name.required' => 'Please enter the Your name',
        ];


        $request->validate($rules, $messages);

        $data = $request->all();

        Doctor::create($data);

        session()->flash('success', 'Doctor Added Successfully!');
        return redirect()->route('dashboard.get-all-doctors');
    }

    public function showDoctor($id)
    {
        $doctor = Doctor::where('id', $id)->first();

        return view('dashboard.pages.doctors.show_doctor')->with(compact('doctor'));
    }


    public function getUpdateDoctor(Request $request, $id)
    {
        $doctor = Doctor::where('id', $id)->first();

        return view('dashboard.pages.doctors.update_doctor', compact('doctor'));
    }

    public function postUpdateDoctor(Request $request, $doctor_id)
    {
        $rules = [
            'name' => 'required',
        ];

        $messages = [
            'name.required' => 'Please enter the your name',
        ];

        $request->validate($rules, $messages);

        try {
            $doctor = Doctor::where('id', $doctor_id)->first();
            $data = $request->except('_token', '_method');
            $doctor->update($data);

            session()->flash('success', 'Doctor Updated Successfully!');

        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return redirect()->route('dashboard.get-all-doctors');
    }


    public function getDoctorDetails(Request $request)
    {
        $doctor_id = $request->doctor_id;
        $doctor = Doctor::where('id', $doctor_id)->first();

        return response()->json(['doctor' => $doctor]);
    }
}
