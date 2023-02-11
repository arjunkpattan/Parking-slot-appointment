<?php

namespace App\Http\Controllers\APi;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'driver_license' => 'required|mimes:pdf|min:2024|max:5125',
        ]);
        if($files=$request->file('driving_licence')){  
            $driving_licence=$files->getClientOriginalName();  
            $files->move('driving-licence',$driving_licence);  
            }
       
        if($validator->fails()){
            
            $response = [
                'success' => false,
                'message' => ($validator->errors()),
            ];    
    
            return response()->json($response, 404);
        }
      $exist_user=User::where('email',$request->email)->first();
       if(isset($exist_user)){
        $response = [
            'success' => false,
            'message' => 'email already taken',
        ];    

        return response()->json($response, 404);
       }
      
        $user = User::create([
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
            'email'=>$request->email,
            "driver_license"=>$driving_licence
        ]);
        
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;
   
        // return $this->sendResponse($success, 'User register successfully.');

        $response = [
            'success' => true,
            'data'    => $success,
            'message' => 'User register successfully.',
        ];


        return response()->json($response, 200);
    }


        /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;
   
            // return $this->sendResponse($success, 'User login successfully.');

            $response = [
                'success' => true,
                'data'    => $success,
                'message' => 'User register successfully.',
            ];
            return response()->json($response, 200);
        } 
        else{ 
            // return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
              
            $response = [
                'success' => false,
                'message' => 'Unauthorised',
            ];    
    
            return response()->json($response, 404);
        } 
    }
}
