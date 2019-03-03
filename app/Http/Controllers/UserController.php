<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['only' => [
            'showOneUser',
            'showAllUsers',
            'update',
            'delete',
            'logout'
        ]]);
    }
    public function showAllUsers()
    {
        return response()->json(User::all());
    }
    public function showOneUser($id)
    {
        return response()->json(User::find($id));
    }
    public function create(Request $request)
    {
        $request['api_token']='NULL';
        $request['password']=app('hash')->make($request['password']);
        $user = User::create($request->all());
        return response()->json($user, 201);
    }
    public function update($id, Request $request)
    {
    	$api_token=$request->api_token;
        $type=User::where('api_token','=',$api_token)->value('type');
        if($type=='admin'){
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
            }
        return response()->json("YOU DON'T HAVE A PROPER PERMISSION",401 );
    }
    public function delete($id,Request $request)
     {    $api_token=$request->api_token;
        $type=User::where('api_token','=',$api_token)->value('type');
         if($type=='admin')
        {
        User::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
        }
        return response()->json("YOU DON'T HAVE A PROPER PERMISSION",401);
    }

    public function login(Request $request)
    {
      $email=$request->email;
      $password=$request->password;
      $user = User::where('email','=',$email)->first();
      if(Hash::check($password, $user->password))
      {
        $api_token=str_random(6);
        $update=User::where('email','=',$email);
        $update->update(['api_token'=>str_random(6)]);
        $api_token=User::where('email','=',$email)->value('api_token');
        return response()->json($api_token);
       }
      return response()->json("user not registered");

    }
    public function logout(Request $request)
    {
        $user=User::where('api_token','=',$request->api_token);
        $user->update(['api_token'=>'NULL']);
        return response()->json("you have been successfully logged out");
        
    }
}
