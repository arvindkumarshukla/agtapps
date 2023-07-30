<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;
use Illuminate\Support\Str;
use Hash;
    
class EmployeeController extends Controller
{
    public function addemployee()
    {
        return view('employee');
    } 

    public function submitemploye(Request $request)
    {  
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ]);
  
        if ($validator->fails()){
            return response()->json([
                    "status" => false,
                    "errors" => $validator->errors()
                ]);
        }
  
        $data = $request->all();

        $empoyee = new Employee;

        $empoyee->name = $request->name;
        $empoyee->email = $request->email;
        $empoyee->password = Hash::make($request->password);
        $empoyee->save();

        return response()->json([
            "status" => true, 
            "msg" => "Employee Saved Successfully",
            "data" => $empoyee
        ]);
        
    }

    public function login(Request $request) {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->messages(), 400);
            }

            $user = Employee::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                return response()->json(['error'=>'The email or password is incorrect, please try again'], 422);
            }

            $token = $user->createToken(Str::random(40));


            return response()->json(['token'=> $token->plainTextToken]);

        } catch ( \Exception $e ) {
            return response()->json(['error'=>$e->getMessage()], 500);
        }
    }

    public function employeedetails($id){
        $val = Employee::find($id);
        
        $data=["status"=>true,'data'=>$val];

        return json_encode($data);
        
    }

}
