<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\employee;
use App\Models\manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class Companycontroller extends Controller
{
    public function updateAdminStatus(Request $request){
    
    $admin = admin::first();
    $admin->status = $request->input('status') ? 0 : 1;
    $admin->save();
    if ($admin->save()) {
        $response['status'] = 1;
        $response['message'] = "Status Updated successfully!";
    } else {
        $response['message'] = "Something's wrong";
    }
    return response()->json($response);
}

    public function add(Request $request){

        $hid =$request->all()['id'];

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $extension = $request->file('image')->extension();
            $image = time() . "." . $extension;
            $path = public_path("/image");
        
            $request->file('image')->move($path, $image);
        } else {
            $image = ""; 
        }

        if($hid != "") {
            $updaterecord = $request->all();
            $updatedata = admin::findOrFail($hid);
    
            $dataToUpdate = [
                "firstname" => $updaterecord["firstname"],
                'lastname' => $updaterecord['lastname'],
                'email' => $updaterecord['email'],
                'password' => $updaterecord['password'],
                'gender' => $updaterecord['gender'],
                'role' => $updaterecord['role'],
                'role_type' => $updaterecord['role_type'],
                'status' => $updaterecord['status']
            ];
            
            if (!empty($image)) {
                $dataToUpdate['image'] = $image;
            }
            
            $updatedata->update($dataToUpdate);

            if ($updatedata) {
                $response['status'] = 1;
                $response['message'] = "Data Updated successfully!";
            } else {
                $response['message'] = "Something's wrong";
            }

        } else {
                $admin = new admin();

                $admin->firstname = $request->firstname;
                $admin->lastname = $request->lastname;
                $admin->email = $request->email;
                $admin->password = $request->password;
                $admin->gender = $request->gender;
                $admin->image = $image;
                $admin->status = $request->status;
                $admin->role = $request->role;
                // $admin->role_type = $request->role_type;
                if ($admin->role === 'admin') {
                    $admin->role_type = '';
                } else {
                    $admin->role_type = $request->role_type;
                }
                $admin->save();

                if ($admin->save()) {
                    $response['status'] = 1;
                    $response['message'] = "Data added successfully!";
                } else {
                    $response['message'] = "Something's wrong";
                }
            }      
            return response()->json($response);
        }
        
    public function list(){
        $managers = manager::all();

        foreach ($managers as $manager) {
            $managerNames[$manager->id] = $manager->manager;
        }
        
        $employees = employee::all();

        foreach ($employees as $employee) {
            $employeeNames[$employee->id] = $employee->employee;
        }
        
        $list = admin::all();

        $aaa = [];
        foreach ($list as $value) {
            if($value->role != "admin"){
                $checked = ($value->status == '0') ? 'checked' : '';
                $row['id'] = $value->id;
                $row['firstname'] = $value->firstname;
                $row['lastname'] = $value->lastname;
                $row['email'] = $value->email;
                $row['password'] = $value->password;
                $row['gender'] = $value->gender;
                $row['image'] = '<img src="'.asset('image/'.$value->image).'"  width="80px" height="80px">';
                $row['role'] = $value->role;
                $row['role_type'] = ($value->role === 'manager' && isset($managerNames[$value->role_type])) ? $managerNames[$value->role_type] : (($value->role === 'employee' && isset($employeeNames[$value->role_type])) ? $employeeNames[$value->role_type] : '');
                $row['status'] = "<div class='form-check form-switch'>
                <input class='form-check-input' type='checkbox' id='statusCheckbox' value='$value->status' $checked>
                </div>";
                $row['action'] = "<button class='btn btn-success' id='edit' data-id=" . $value->id . ">Edit</button>
                <button class='btn btn-warning' id='delete' data-id=" . $value->id . ">Delete</button>";
                array_push($aaa, $row);
            }
        }
        return response()->json(['data' => $aaa]);
    }

    public function edit(Request $request){
        $edit = $request->all();
        $id = $edit['id'];

        $data = admin::find($id)->toArray();

        if ($data['role'] == "manager") {
            $manager_data = manager::all()->toArray();
            $response['manager_data'] = $manager_data;

        } elseif ($data['role'] == "employee") {
            $employee_data = employee::all()->toArray();
            $response['employee_data'] = $employee_data;
        }

        $alldata = [$response, $data];
        return response()->json(['alldata' => $alldata ]);
    }

    public function delete(Request $request){
                $id = $request->input('id');

                $admin = admin::find($id);
            
            if ($admin) {
                    $imageName = $admin->image;
                    $admin->delete();
                    $path = public_path("image/{$imageName}");
                    if (file_exists($path)) {
                        unlink($path);
                        }
            }
            if ($admin) {
                $response['status'] = 1;
                $response['message'] = "Data Deleted successfully!";
            } else {
                $response['message'] = "Something's wrong";
            }
            return response()->json($response);
        }

    public function displayData(){
        $managers = manager::all();

        foreach ($managers as $manager) {
            $managerNames[$manager->id] = $manager->manager;
        }
        
        $employees = employee::all();

        foreach ($employees as $employee) {
            $employeeNames[$employee->id] = $employee->employee;
        }

        $list = admin::all();
        $aaa = [];
        foreach ($list as $value) {
            if($value-> role != "admin"){
                $row['firstname'] = $value->firstname;
                $row['lastname'] = $value->lastname;
                $row['email'] = $value->email;
                $row['password'] = $value->password;
                $row['gender'] = $value->gender;
                $row['image'] = '<img src="'.asset('image/'.$value->image).'"  width="260px" height="160px">';
                $row['role'] = $value->role;
                $row['role_type'] = ($value->role === 'manager' && isset($managerNames[$value->role_type])) ? $managerNames[$value->role_type] : (($value->role === 'employee' && isset($employeeNames[$value->role_type])) ? $employeeNames[$value->role_type] : '');
                $row['status'] = $value->status;
                array_push($aaa, $row);
            }
        }
        return response()->json(['data' => $aaa]);
    }

    public function getmanageroptions(){

        $managers = manager::all();
        // $managers = manager::select('id')->get();
        // $employees = employee::select('id')->get();
        $employees = employee::all();

        $data = ['managers' => $managers,'employees' => $employees];
        return response()->json($data);
    }

}

