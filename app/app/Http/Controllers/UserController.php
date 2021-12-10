<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



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
     
        //login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'state' => 'inactive'])) {
            $status = 200;
            $response = [
                'user' => Auth::user(),
                'token' => Auth::user()->createToken('bigStore')->accessToken,
            ];
        }

        $user = Auth::user();
        if (Auth::check()) {
            // The user is logged in... 
            $user->update(
                ['state'=>"active"]
            );   
        }
        
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
    public function updateStateAccount(Request $request){
        $user = User::where('email',$request->email);
        error_log($request->email);
        $user->update(
            ['state'=>$request->state]
        );  
        return response()->json([
            'status' => $user,
            'message' => $user? 'User state updated!' : 'Error'
        ]);

    }
    public function changePass(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'old_password' => 'required|min:1',
            'new_password' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        //login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'state' => 'active'])) {
            $status = 200;
            $response = [
                'user' => Auth::user(),
                'token' => Auth::user()->createToken('bigStore')->accessToken,
            ];
        }

        $user = Auth::user();
        if (Auth::check()) {
            // The user is logged in... 
            $user->update(
                ['password'=>bcrypt($request->new_password)]
            );   
        }
        return response()->json([
            'status' => $user,
            'message' => $user? 'User password updated!' : 'Error'
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

