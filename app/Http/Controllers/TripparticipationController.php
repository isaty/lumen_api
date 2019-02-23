<?php
namespace App\Http\Controllers;
use App\Tripparticipation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Hashing\BcryptHasher;
class TripparticipationController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['only' => [
            'search',
            'create',
            'delete'
        ]]);
    }
public function search($id)
{
	$people=Tripparticipation::findorFail($id);
    if($people)
 	return response()->json($people);

    return response("no such trip exixts");
}

public function create(Request $request)
{    $api_token=$request->api_token;
     $type=User::where('api_token','=',$api_token)->value('type');
     if($type=="user")
     	{
     		Tripparticipation::create($request->all());
            return response("trip participation"); 
         }
      return response("NOT ALLOWED");
}

public function delete($id,Request $request)
{
  $api_token=$request->api_token;
  $type=User::where('api_token','=',$api_token)->value('type');
  if($type=="trip organiser")
  {
    if($trip_organiser=User::where('api_token','=',$api_token)->value('email'))
	  { 
		if($trip_organiser==Trip::where('trip_id','=',$id)->value('trip_organiser')){
		$trip=Tripparticipation::where('trip_id','=',$id)->delete();
		return response("TRIP DELETED ",200);
	   }
	 return response("MISMATCH",401);
    }

   }
 else if($type=="user")
   {  
   	 $user=User::where('api_token','=',$api_token)->value('email');
     if($user=Tripparticipation::where('trip_id','=',$id)->value('user'))
     {
     	$trip=Tripparticipation::where('trip_id','=',$id)->delete();
		return response("TRIP DELETED ",200);
     }   
     return response("WRONG USER");	
   
   }
	return response("YOU DON'T HAVE PROPER PERMISSION",401);

}

}