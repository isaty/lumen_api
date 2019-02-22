<?php
namespace App\Http\Controllers;
use App\;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Hashing\BcryptHasher;
class ScheduleController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['only' => [
            'search'
        ]]);
    }
public function search($source,$destination)
{
$trip=Trip::where('source',$source)->where('destination',$destination)->get();
return response()->json($trip);
}



}