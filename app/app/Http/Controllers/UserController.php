<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Validator;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }

    public function login(Request $request)
    {
        $status = 401;
        $response = ['error' => 'Unauthorised'];

        if (Auth::attempt($request->only(['email', 'password']))) {
            $status = 200;
            $response = [
                'user' => Auth::user(),
                'token' => Auth::user()->createToken('bigStore')->accessToken,
            ];
        }
        $user = User::where('email',$request->email);
        $user->update(
            ['state'=>"active"]
        );    
        return response()->json($response, $status);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'password' => 'required|min:1',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $data = $request->only(['name', 'email', 'password','role','state']);
        $data['password'] = bcrypt($data['password']);
        
        
        $user = User::create($data);
        
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('bigStore')->accessToken,
        ]);
    }
   
    public function log_out(Request $request)
    {
        $user = User::where('email',$request->email);
        error_log($request->email);
        $user->update(
            ['state'=>"inactive"]
        );  
        return response()->json([
            'status' => $user,
            'message' => $user? 'User Loggout!' : 'Error Loggout User'
        ]);
    }
    public function details()
    {
        $user = Auth::user();

        return response()->json(
            [
                'success' => $user
            ],  
            $this->successStatus
        );
    }
    public function destroy($email)
    {
        $user = User::where('email',$email);
        $status = $user->forceDelete();
        return response()->json([
            'status' => $status,
            'message' => $status ? 'User Deleted!' : 'Error Deleting User'
        ]);
       
    }
    public function showOrders(User $user)
    {
        return response()->json($user->orders()->with(['product'])->get());
    }

}

