<?php

namespace App\Http\Controllers;

use App\Profile;
use App\EyeColor;
use App\EyeWear;
use App\Height;
use App\Ethnicity;
use App\Gender;
use App\EmailVerification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\UserEmailVerificationNofication;
use Validator;
use Hash;
use Mail;
use Auth;
use Carbon\Carbon;
class ProfileController extends Controller
{
    public function eyeColor(){
        $eyeColor = EyeColor::all();
        return view('admin.eye-color' ,compact('eyeColor'));
    }

    public function userGender(){
        $genders = Gender::all();
        return view('admin.gender' ,compact('genders'));
    }


    public function eyeWear(){
        $eyeWear = EyeWear::all();
        return view('admin.eye-wear' ,compact('eyeWear'));
    }

    public function Height(){
        $heights = Height::all();
        return view('admin.height' ,compact('heights'));
    }

    public function userEthnicity(){
        $ethnicity = Ethnicity::all();
        return view('admin.ethnicity' ,compact('ethnicity'));
    }


    public function processEyeColor(Request $request){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:eye_colors',
            ]);

            if($validator->fails()){
                $errors=$validator->errors()->all();
                return response()->json([
                    'status'=>'info',
                    'message'=>$errors
                ]);

            }

            $eyeColor = new EyeColor;

            $eyeColor->name =$request->name;

            if ($eyeColor->save()) {
                return redirect()->back()->with([
                    'status'=>'success',
                    'message'=>'Eye Color successfully added!'
                ]); 
            }

            return redirect()->back()->with([
                'status'=>'info',
                'message'=>'Error occurred, try again later.'
            ]); 


    }
    public function processEyeWear(Request $request){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:eye_wears',
            ]);

            if($validator->fails()){
                $errors=$validator->errors()->all();
                return response()->json([
                    'status'=>'info',
                    'message'=>$errors
                ]);

            }

            $eyeWear = new EyeWear;

            $eyeWear->name =$request->name;

            if ($eyeWear->save()) {
                return redirect()->back()->with([
                    'status'=>'success',
                    'message'=>'Eye wear successfully added!'
                ]); 
            }

            return redirect()->back()->with([
                'status'=>'info',
                'message'=>'Error occurred, try again later.'
            ]); 


    }
    public function processGender(Request $request){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:genders',
            ]);

            if($validator->fails()){
                $errors=$validator->errors()->all();
                return response()->json([
                    'status'=>'info',
                    'message'=>$errors
                ]);

            }

            $gender = new Gender;

            $gender->name =$request->name;

            if ($gender->save()) {
                return redirect()->back()->with([
                    'status'=>'success',
                    'message'=>'Gender successfully added!'
                ]); 
            }

            return redirect()->back()->with([
                'status'=>'info',
                'message'=>'Error occurred, try again later.'
            ]); 


    }
    public function processEthnicity(Request $request){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:eye_wears',
            ]);

            if($validator->fails()){
                $errors=$validator->errors()->all();
                return response()->json([
                    'status'=>'info',
                    'message'=>$errors
                ]);

            }

            $ethnicity = new Ethnicity;

            $ethnicity->name =$request->name;

            if ($ethnicity->save()) {
                return redirect()->back()->with([
                    'status'=>'success',
                    'message'=>'Ethnicitysuccessfully added!'
                ]); 
            }

            return redirect()->back()->with([
                'status'=>'info',
                'message'=>'Error occurred, try again later.'
            ]); 


    }
    public function processHeight(Request $request){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:heights',
            ]);

            if($validator->fails()){
                $errors=$validator->errors()->all();
                return response()->json([
                    'status'=>'info',
                    'message'=>$errors
                ]);

            }

            $userHeight = new Height;

            $userHeight->name =$request->name;

            if ($userHeight->save()) {
                return redirect()->back()->with([
                    'status'=>'success',
                    'message'=>'Height successfully added!'
                ]); 
            }

            return redirect()->back()->with([
                'status'=>'info',
                'message'=>'Error occurred, try again later.'
            ]); 


    }

    public function destroyEyeColor(Request $request)
    {
        if (!empty($request->id)) {
            $id =$request->id;

            if (EyeColor::where("id",$id)->delete()) {
                return response()->json([
                    'message' => 'Eye Color successfully deleted!',
                    'status' => 'success',
                ]);

            } else {
                return response()->json([
                    'message' => 'Error occured please try again later',
                    'status' => 'info'
                ]);
            }


        }else{
           return response()->json([
                'message' => 'Error occured please try again later',
                'status' => 'info',
            ]);
        }
    }

    public function destroyEyeWear(Request $request)
    {
        if (!empty($request->id)) {
            $id =$request->id;

            if (EyeWear::where("id",$id)->delete()) {
                return response()->json([
                    'message' => 'Eye wear successfully deleted!',
                    'status' => 'success',
                ]);

            } else {
                return response()->json([
                    'message' => 'Error occured please try again later',
                    'status' => 'info'
                ]);
            }


        }else{
           return response()->json([
                'message' => 'Error occured please try again later',
                'status' => 'info',
            ]);
        }
    }

    public function destroyHeight(Request $request)
    {
        if (!empty($request->id)) {
            $id =$request->id;

            if (Height::where("id",$id)->delete()) {
                return response()->json([
                    'message' => 'Height successfully deleted!',
                    'status' => 'success',
                ]);

            } else {
                return response()->json([
                    'message' => 'Error occured please try again later',
                    'status' => 'info'
                ]);
            }


        }else{
           return response()->json([
                'message' => 'Error occured please try again later',
                'status' => 'info',
            ]);
        }
    }

    public function destroyGender(Request $request)
    {
        if (!empty($request->id)) {
            $id =$request->id;

            if (Gender::where("id",$id)->delete()) {
                return response()->json([
                    'message' => 'Gender successfully deleted!',
                    'status' => 'success',
                ]);

            } else {
                return response()->json([
                    'message' => 'Error occured please try again later',
                    'status' => 'info'
                ]);
            }


        }else{
           return response()->json([
                'message' => 'Error occured please try again later',
                'status' => 'info',
            ]);
        }
    }

    public function destroyEthnicity(Request $request)
    {
        if (!empty($request->id)) {
            $id =$request->id;

            if (Ethnicity::where("id",$id)->delete()) {
                return response()->json([
                    'message' => 'Ethnicity successfully deleted!',
                    'status' => 'success',
                ]);

            } else {
                return response()->json([
                    'message' => 'Error occured please try again later',
                    'status' => 'info'
                ]);
            }


        }else{
           return response()->json([
                'message' => 'Error occured please try again later',
                'status' => 'info',
            ]);
        }
    }


    public function EditEyeColor(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'name' =>'required',
            'eye_id'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'=>implode(' ', $validator->errors()->all()),
                'status' => 'info'
            ]);
        }

        $update =EyeColor::where('id',$request->eye_id)->update([
            'name'=>$request->name
        ]);

        if ($update) {
            return response()->json([
                'message' => 'Eye color successfully Updated!',
                'status' => 'success',
            ]);
        }else{
            return response()->json([
                'message' => 'Error occured please try again later',
                'status' => 'info'
            ]);
        }
    }


    public function EditEyeWear(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'name' =>'required',
            'eye_wear_id'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'=>implode(' ', $validator->errors()->all()),
                'status' => 'info'
            ]);
        }

        $update =EyeWear::where('id',$request->eye_wear_id)->update([
            'name'=>$request->name
        ]);

        if ($update) {
            return response()->json([
                'message' => 'Eye wear successfully Updated!',
                'status' => 'success',
            ]);
        }else{
            return response()->json([
                'message' => 'Error occured please try again later',
                'status' => 'info'
            ]);
        }
    }

    public function EditHeight(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'name' =>'required',
            'height_id'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'=>implode(' ', $validator->errors()->all()),
                'status' => 'info'
            ]);
        }

        $update =Height::where('id',$request->height_id)->update([
            'name'=>$request->name
        ]);

        if ($update) {
            return response()->json([
                'message' => 'Height successfully Updated!',
                'status' => 'success',
            ]);
        }else{
            return response()->json([
                'message' => 'Error occured please try again later',
                'status' => 'info'
            ]);
        }
    }

    public function EditEthnicity(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'name' =>'required',
            'ethnicity_id'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'=>implode(' ', $validator->errors()->all()),
                'status' => 'info'
            ]);
        }

        $update =Ethnicity::where('id',$request->ethnicity_id)->update([
            'name'=>$request->name
        ]);

        if ($update) {
            return response()->json([
                'message' => 'Ethnicity successfully Updated!',
                'status' => 'success',
            ]);
        }else{
            return response()->json([
                'message' => 'Error occured please try again later',
                'status' => 'info'
            ]);
        }
    }

    public function EditGender(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'name' =>'required',
            'gender_id'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'=>implode(' ', $validator->errors()->all()),
                'status' => 'info'
            ]);
        }

        $update =Gender::where('id',$request->gender_id)->update([
            'name'=>$request->name
        ]);

        if ($update) {
            return response()->json([
                'message' => 'Gender successfully Updated!',
                'status' => 'success',
            ]);
        }else{
            return response()->json([
                'message' => 'Error occured please try again later',
                'status' => 'info'
            ]);
        }
    }


    public function completeUserProfile(Request $request){
        $data=$request->all();

        $exception = DB::transaction(function () use ($data) {
            try {

                if (Profile::where('user_id',$data['user_id'])->exists()) {
                    $profile_id = Profile::where('user_id',$data['user_id'])->first()->id;

                    Profile::where('user_id',$data['user_id'])->update([
                        'country_id'=>$data['country'],

                        'city_id'=>$data['city'],

                        'hair_type_id'=>$data['hair_type'],

                        'hair_color_id'=>$data['hair_color'],

                        'eye_color_id'=>$data['eye_color'],

                        'eye_wear_id'=>$data['eye_wear']
                    ]);

                    User::where('id',$data['user_id'])->update([
                        'profile_id'=>$profile_id,
                        'phonenumber'=>$data['phonenumber'],
                        'seeking_id'=>$data['seeking'],
                    ]);
                }else{
                    $profile = new Profile;
                    $profile->country_id =$data['country'];
                    
                    $profile->user_id =$data['user_id'];

                    $profile->city_id =$data['city'];

                    $profile->hair_type_id =$data['hair_type'];

                    $profile->hair_color_id =$data['hair_color'];

                    $profile->eye_color_id =$data['eye_color'];

                    $profile->eye_wear_id =$data['eye_wear'];

                    if ($profile->save()) {
                        User::where('id',$data['user_id'])->update([
                            'profile_id'=>$profile->id,
                            'phonenumber'=>$data['phonenumber'],
                            'seeking_id'=>$data['seeking'],
                        ]);
                    }
                }



            } catch (Exception $e) {
            }
        });

        if (is_null($exception)) {
            return response()->json([
                'message' => 'User Profile successfully updated',
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'message' => 'Error occured , please try again later!',
                'status' => 'info',
            ]);
        }
    }


    public function sendEmailVerification(Request $request){
        if ($request->isMethod('get')) {

            $message ="We also don't know what you are trying to do";

            if (!empty($request->token)) {
                $token  =$request->token;

                if (EmailVerification::where('token', $token)->exists()) {

                    $email =EmailVerification::where('token', $token)->first()->email;

                    $current = Carbon::now();

                    $update= User::where('email',$email)->update([
                        'email_verified_at'=>$current
                    ]);

                    $notification= [
                        'message' => 'Action failed ,try again later!',
                        'status' => 'info'
                    ];

                    if ($update) {
                        EmailVerification::where('email',$email)->delete();
                        $notification= [
                            'message' => 'Account successfully verified!',
                            'status' => 'success'
                        ];
                    }

                    return redirect()->route('user-dashboard')->with($notification);

                }else{
                    Auth::logout();
                    $message = "Invalid email verification link.";
                }
            }

            return view('user.404',compact('message'));
        }else if($request->isMethod('post')){

            $user= User::where('id',$request->id)->first();

            $email =$user->email;

            $username = $user->username!==null ? $user->username : 'there';

            if ($email!==null && !empty($email)) {

                EmailVerification::where('email',$email)->delete();

                $token =md5($email).'_'.now()->timestamp;

                $url =route('process-send-email-verification' ,['token'=>$token]);


                $verification = new EmailVerification;
                $verification->email = $email;
                $verification->email_sent = "YES";
                $verification->token =$token;

                if ($verification->save()) {


                    try {
                        Mail::to($email)->queue(
                            new UserEmailVerificationNofication($username,$url)
                        );


                    } catch (\Exception $e) {

                        EmailVerification::where('id',$verification->id)->update([
                            'email_sent'=>'NO'
                        ]);

                        return response()->json([
                            'status'=>'info',
                            'message'=>'Action failed ,Try again later!'
                        ]);
                    }

                    return response()->json([
                        'status'=>'success',
                        'message'=>'Email verification link sent, visit your email inbox and verify your account!'
                    ]);

                }else{
                    return response()->json([
                        'message' => 'Error occured ,Try again later!',
                        'status' => 'info',
                    ]);
                }

            }else{
                return response()->json([
                    'message' => 'Error occured ,Email not found!',
                    'status' => 'info',
                ]);
            }

        }

    }


}
