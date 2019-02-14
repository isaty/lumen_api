<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Hashing\BcryptHasher;
class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['only' => [
            'showOneUser',
            'showAllUsers',
            'update',
            'delete'
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
        $request['api_token']=str_random(6);
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
         if($type=='admin'){
        User::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
        return response()->json("YOU DON'T HAVE A PROPER PERMISSION",401);
    }

}