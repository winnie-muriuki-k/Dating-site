<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Matches;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Countries;
use App\FacialHairTypes;
use App\HairColor;
use App\HairType;
use App\EyeColor;
use App\EyeWear;
use App\Cities;
use App\Ethnicity;
use App\Gender;
use App\Height;
use App\Favourite;

class SubscriptionController extends BaseController
{
    public function checkAccountVeriffied(Request $request){
        if (Auth::check() && Auth::user()->role=="customer") {
            $new_favourites = Favourite::where(['recipient_id'=>Auth::user()->id, 'status'=>0])->get();
            $recent_activity = Favourite::where(['recipient_id'=>Auth::user()->id])->latest()->limit(6)->get();

        	$countries =Countries::select('id','name')->get();

        	$facialHairTypes =FacialHairTypes::select('id','name')->get();

        	$hairColor =HairColor::select('id','name')->get();

        	$hairType =HairType::select('id','name')->get();
        	
        	$eyeColor =EyeColor::select('id','name')->get();

            $eyeWear =EyeWear::select('id','name')->get();

            $ethnicity =Ethnicity::select('id','name')->get();

            $gender =Gender::select('id','name')->get();
            $height =Height::select('id','name')->get();

            $interest_recent_activity = Matches::where(['recipient'=>Auth::user()->id,'confirmed'=>'0'])->where('initator', '!=', Auth::user()->id )->latest()->limit(6)->get();
          //  $interests = Matches::with('user_recipient')->where(['recipient'=>$id])->where('initator', '!=', $user_id)->paginate(3);

            return view('user.complete-profile',compact('interest_recent_activity','recent_activity','countries','new_favourites','facialHairTypes','height','ethnicity','gender',
                'hairColor','hairType','eyeColor','eyeWear'));
        }

        // return response()->json([
        //     'message'=>'Unauthorised request! We are watching you *_* '
        // ]);
            return redirect()->route('user-login')->with([
                'status'=>'info',
                'message'=>'Login to proceed!'
            ]); 
    }

    public function getCountryCities(Request $request){
    	if (!empty($request->id)) {
    		$data=Cities::where('country_id',$request->id)->select('id','name')->get();
    		return response()->json([
    			'status'=>'success',
    			'message'=>'',
    			'data'=>$data
    		]);
    	}
		return response()->json([
			'status'=>'info',
			'message'=>'Error occurred , contact administrator.'
		]);
    }
}
