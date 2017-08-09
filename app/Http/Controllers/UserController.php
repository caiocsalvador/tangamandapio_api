<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use JWTAuthException;

class UserController extends Controller
{

    /*private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }*/
   
    public function create(Request $request)
    {   
        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        
        
        try {
            $user = User::create($input);
            return response()->json(array('status'=> true ,'message' => 'User created successfully', 'data' => $user), 200);
        }
        catch (\Exception $e) {            
            return response()->json(['error' => $e->getMessage()]);
        }

        
        
        /*$user->create([
          'name' => $request->input('name'),
          'email' => $request->input('email'),
          'role_id' => $request->input('role_id'),
          'password' => bcrypt($request->input('password'))
        ]);*/
        /*return response()->json(['test' => $request->password]);*/
        
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['invalid_email_or_password'], 422);
            }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    public function getAuthenticatedUser(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        return response()->json(['result' => $user]);
    }
}
