<?php
namespace App\Http\Controllers;
use App\Trip;
use App\User;
use App\Checkpoints;
use Illuminate\Http\Request;
use Illuminate\Hashing\BcryptHasher;
class TripController extends Controller{

    public function __construct() {
        $this->middleware('auth', ['only' => [
            'search',
             'create',
             'delete',
             'modify'
                    ]]);
    }
public function search($source,$destination)
{
$trip=Trip::where('source',$source)->where('destination',$destination)->get();
return response()->json($trip);
}

public function create(Request $request)
{
	$api_token=$request->api_token;
	if(User::where('api_token','=',$api_token)->where('type','=','trip organiser')->exists())
	{
		Trip::create($request->all());
     	Checkpoints::create([
     		'trip_id'=>$request->trip_id,
     		'checkpoint_no'=>'source',
     		'checkpoint'=>$request->source//earlier it was checkpoint
     	]);
     	Checkpoints::create([
     		'trip_id'=>$request->trip_id,
     		'checkpoint_no'=>'destination',
     		'checkpoint'=>$request->destination//earlier it was checkpoint
     	]);
	return response($request,200);
	}
	return response("YOU DON'T HAVE PROPER PERMISSION",401);
}

public function delete($id,Request $request)
{
	$api_token=$request->api_token;
	if($trip_organiser=User::where('api_token','=',$api_token)->where('type','=','trip organiser')->value('email'))
	{ 
		if($trip_organiser==Trip::where('trip_id','=',$id)->value('trip_organiser')){
		$trip=Trip::where('trip_id','=',$id)->delete();
		return response("TRIP DELETED ",200);
	}
	return response("MISMATCH",401);
	}
	return response("YOU DON'T HAVE PROPER PERMISSION",401);
}

public function modify($id,Request $request)
{
	$api_token=$request->api_token;
	if($trip_organiser=User::where('api_token','=',$api_token)->where('type','=','trip organiser')->value('email'))
	{ 
		if($trip_organiser==Trip::where('trip_id','=',$id)->value('trip_organiser')){
		$trip=Trip::where('trip_id','=',$id)->update($request->all());
		return response("TRIP UPDATED ",200);
	}
	return response("MISMATCH",401);
	}
	return response("YOU DON'T HAVE PROPER PERMISSION",401);

}
}
