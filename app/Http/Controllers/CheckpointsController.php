<?php
namespace App\Http\Controllers;
use App\Checkpoints;
use App\Trip;
use App\User;
use Illuminate\Http\Request;
class CheckpointsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => [
            'search',
            'modify',
            'delete',
            'create',
        ]]);
    }
    public function search($id)
    {
    }
    public function create(Request $request)
    {
        $api_token = $request->api_token;
        $type = User::where('api_token', '=', $api_token)->where('type', '=', 'trip organiser')->value('email');
        //$user=User::where('api_token', '=', $api_token)->value('email');
        if ($type && Trip::where('trip_id', '=', $request->trip_id)->where('trip_organiser', '=', $type)->exists()) {
            Checkpoints::create($request->all());
            return response("created", 200);
        }
        return response("not allowed", 401);
    }
    public function delete($id, Request $request)
    {
        $api_token = $request->api_token;
        $type = User::where('api_token', '=', $api_token)->where('type', '=', 'trip organiser')->value('email');
        //$user=User::where('api_token', '=', $api_token)->value('email');
        if ($type && Trip::where('trip_id', '=', $id)->where('trip_organiser', '=', $type)->exists()) {
            Checkpoints::findorFail($id)->delete();
            return response("deleted", 200);
        }
        return response("not allowed", 401);
    }
    public function modify($id, Request $request)
    {
        $api_token = $request->api_token;
        $type = User::where('api_token', '=', $api_token)->where('type', '=', 'trip organiser')->value('email');
        //$user=User::where('api_token', '=', $api_token)->value('email');
        if ($type && Trip::where('trip_id', '=', $request->trip_id)->where('trip_organiser', '=', $type)->exists()) {
            Checkpoints::update($request->all());
            return response("updated", 200);
        }
        return response("not allowed", 401);
    }
}