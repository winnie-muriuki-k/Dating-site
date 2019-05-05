<?php

namespace App\Http\Controllers\User;

use App\Countries;
use App\EyeColor;
use App\EyeWear;
use App\HairColor;
use App\HairLength;
use App\HairType;
use App\Profile;
use Intervention\Image\ImageManagerStatic as Image;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Matches;
use App\PasswordReset;
use App\Message;
use Mail;
use Session;
use Redirect;
use App\Mail\UserPasswordReset;
use App\Mail\NewUserNotification;
use App\Mail\MatchNotification;
use App\Mail\MessageNotification;
use App\Conversation;
use App\Notification;
use Illuminate\Support\Facades\DB;

use Hash;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if($request->isMethod('GET')){
            return view('user.login');
        }
        if ($request->isMethod('POST')) {
            if (!User::where('email',$request->email)->exists()) {
                return response()->json([
                    'status'=>'info',
                    'message'=>'User not found!'
                ]);
            }

            if (Auth::attempt($request->all())) {
                $user=Auth::user();
                if ($user->role=="customer") {
                    return response()->json([
                        'status'=>'success',
                        'code'=>1
                    ]);
                }
                if ($user->role=="admin") {
                    return response()->json([
                        'status'=>'success',
                        'code'=>2
                    ]);
                }

            }else{
                return response()->json([
                    'status'=>'info',
                    'message'=>'Invalid login credentials ,Try again later!'
                ]);
            }
        }
    }
    public function update_avatar(Request $request){

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path().'/avatars/'. $filename);
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
            return response()->json([
                'status'=>'success',
                'message'=>'Profile picture Updated Successfully'
            ]);
        }
        $user_id = Auth::user()->id;
        $users= User::with(['match'])->where(['role'=>'customer'])->where('id','!=',$user_id)->get();
        return view('user.dashboard',  compact('users') );

    }

    public function profile ()
    {
        if (!Auth::check()) {
            return redirect()->route('user-login')->with([
                'status'=>'info',
                'message'=>'Login to proceed!'
            ]); 
        }
        $user_id=Auth::user()->id;

        $notifications = Notification::where(['user_id'=>$user_id,'status'=>'unread'])->get();

        $all_notifications = Notification::where(['user_id'=>$user_id])->orderBy('id', 'DESC')->get();

        $unread_messages =Message::where(['user_id'=>$user_id,'read_status'=>'read'])->get();

        $users= User::with(['match'])->where(['role'=>'customer'])->where('id','!=',$user_id)->paginate(15);

        return view('user.profile', compact('unread_messages','notifications','all_notifications', 'users'));
    }

    public function passwordReset(Request $request){
        if ($request->isMethod('GET')) {
            return view('user.password-reset');
        }

        if ($request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|max:255',
            ]);
            if($validator->fails()){
                $errors=$validator->errors()->all();
                return response()->json([
                    'status'=>'info',
                    'message'=>$errors
                ]);
            }else{
                $email=$request->email;
                if (User::where('email',$email)->exists()) {

                    $token =Hash::make($email) .now()->timestamp;

                    $str=str_replace('/', '', $token);

                    $url= config('app.url').'/user/password/reset/'.$str;

                    $username =!empty(User::where('email',$email)->first()->username) ? User::where('email',$email)->first()->username :'there';

                    $text = "Hello ".$username .", please follow the link below that you have requested to change your account password";
                    try {
                        Mail::to($email)->queue(
                            new UserPasswordReset($email,$url,$text)
                        );

                        PasswordReset::where('email',$email)->delete();

                        PasswordReset::create([
                            'email'=>$email,
                            'token'=>$str
                        ]);


                    } catch (\Exception $e) {
                        // return $e->getMessage();
                        return response()->json([
                            'status'=>'info',
                            'message'=>'Action failed ,Try again later!'
                        ]);
                    }
                        return response()->json([
                            'status'=>'success',
                            'message'=>'Check your email for the link.'
                        ]);
                }else{
                    return response()->json([
                        'status'=>'info',
                        'message'=>'User information not found ,Register for a new account!'
                    ]);
                }
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'gender' => 'required',
                'password' => 'required',
                'age' => 'required',
                'email' => 'required|email|unique:users|max:255',
            ]);
            if($validator->fails()){
                $errors=$validator->errors()->all();
                return response()->json([
                    'status'=>'info',
                    'message'=>$errors
                ]);
            }else{

                $avatar = $request->gender=="male" ? "male-icon.png" : "female-icon.jpg";

                $create =User::create([
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'gender'=>$request->gender,
                    'age'=>$request->age,
                    'avatar'=>$avatar,
                    'password'=>Hash::make($request->password)
                ]);

                if ($create) {
                    try {
                        Mail::to($request->email)->queue(
                            new NewUserNotification()
                        );

                    } catch (\Exception $e) {
                        // return $e->getMessage();
                        return response()->json([
                            'status'=>'info',
                            'message'=>'Action failed ,Try again later!'
                        ]);
                    }
                    return response()->json([
                        'status'=>'success',
                        'message'=>'Registration was successful,login to proceed'
                    ]);
                }else{
                    return response()->json([
                        'status'=>'info',
                        'message'=>'Registration failed , try again later'
                    ]);
                }

            }
        }else if ($request->isMethod('GET')) {
           return view('user.register');
        }else{
            return response()->json([
                'status'=>'info',
                'message'=>'invalid request method'
            ]);
        }
    }
    public function editProfile(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('user-login')->with([
                'status'=>'info',
                'message'=>'Login to proceed!'
            ]); 
        }
        $user_id=Auth::user()->id;

        $notifications = Notification::where(['user_id'=>$user_id,'status'=>'unread'])->get();
        $all_notifications = Notification::where(['user_id'=>$user_id])->orderBy('id', 'DESC')->get();
        $unread_messages =Message::where(['sender'=>$user_id,'read_status'=>'read'])->get();
        $hair_lengths = HairLength::all();
        $hair_colors = HairColor::all();
        $countries = Countries::all();
        $hair_types = HairType::all();
        $eye_colors =EyeColor::all();
        $eye_wears =EyeWear::all();

        if ($request->isMethod('POST')) {
            $validator =Validator::make($request->all(),[
                'dob' => 'required',
                'country' => 'required',
                'city' => 'required',
                'hair_color' => 'required',
                'hair_type' => 'required',
                'eye_color' => 'required',
                'eye_wear' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'=>'info',
                    'message'=>$validator->errors()->all()
                ]);
            }else{
                $user = Auth::user();
                if(!is_null($user->profile_id)){
                    $profile_model = Profile::where(['id'=> $user->profile_id])->first();
                }else{
                    $profile_model = new Profile();
                }
                $user->dob = $request->dob;
                $profile_model->user_id = Auth::user()->id;
                $profile_model->country_id = $request->country;
                $profile_model->city_id = $request->city;
                $profile_model->hair_color_id = $request->hair_color;
                $profile_model->hair_type_id = $request->hair_type;
                $profile_model->eye_color_id = $request->eye_color;
                $profile_model->eye_wear_id = $request->eye_wear;

                if ($profile_model->save()) {
                    $user->profile_id = $profile_model->id;
                    $user->save();
                    Session::flash('message', "Profile Updated Succesfully");
                    return Redirect::back();
                }else{
                    return response()->json([
                        'status'=>'info',
                        'message'=>'Error occurred , try again later.'
                    ]);
                }
            }


        }else if ($request->isMethod('GET')) {

            return view('user.edit-profile', compact('eye_wears','eye_colors','hair_types','hair_lengths','hair_colors','unread_messages','notifications','all_notifications','countries'));
        }else{
            return response()->json([
                'status'=>'info',
                'message'=>'invalid request method'
            ]);
        }
    }


    public function dashboard(){
        if (Auth::check()) {
            if (Auth::user()->role=="customer") {
                $user_id=Auth::user()->id;

                $notifications = Notification::where(['user_id'=>$user_id,'status'=>'unread'])->get();

                $all_notifications = Notification::where(['user_id'=>$user_id])->orderBy('id', 'DESC')->get();

                $unread_messages =Conversation::with(['messages'])
                ->where(['person_one'=>$user_id])
                ->orWhere(['person_two'=>$user_id])->get();


                $users= User::with(['match'])->where(['role'=>'customer'])->where('id','!=',$user_id)->paginate(15);

                return view('user.dashboard',compact('users','unread_messages','notifications','all_notifications'));
            }
            if (Auth::user()->role=="admin") {
                # code...
            }
        }else{
            return redirect()->route('user-login')->with([
                'status'=>'info',
                'message'=>'Login to proceed!'
            ]); 
        }
        
    }


    public function resetToken($token){

        if (!empty($token)) {

            if (PasswordReset::where('token',$token)->exists()) {

                return view('user.passord_reset_form',compact('token'));
            }else{
                return redirect()->route('user-password-reset')->with([
                    'status'=>'info',
                    'message'=>'Invalid link, request for a new one!'
                ]); 
            }
            # code...
        }else{
            return redirect()->route('user-login')->with([
                'status'=>'info',
                'message'=>'Login to proceed!'
            ]); 
        }
    }
    public function update(Request $request, $id)
    {
        //
    }

    public function PasswordResetReal(Request $request){
        if (empty($request->token)) {
            return response()->json([
                'status'=>'info',
                'message'=>'invalid link ,request for a new one'
            ]);
        }
        $email = PasswordReset::where('token',$request->token)->first()->email;

        if (!empty($email)) {
           $update = User::Where('email',$email)->update([
            'password'=>Hash::make($request->password)
           ]);

           if ( $update) {
                 PasswordReset::where('token',$request->token)->delete();
                 
                return response()->json([
                    'status'=>'success',
                    'message'=>'Password reset was successful, you will be redirect to login in 2 seconds.'
                ]);
           }else{
                return response()->json([
                    'status'=>'info',
                    'message'=>'Error occuered ,try again later.'
                ]);
           }
        }else{
            return response()->json([
                'status'=>'info',
                'message'=>'Error occuered ,try again later.'
            ]);
        }
    }

    public function destroy($id)
    {
        //
    }

    public function UserLogout(Request $request){
        Auth::logout();
        return redirect()->route('user-login');
    }

    public function MatchUser(Request $request){

        if (Matches::where(['recipient'=>$request->initiator,'initator'=>$request->recipient])->exists()) {
            # code...
            $username = User::where(['id'=>$request->recipient])->first()->username;

            $match_confirmation =Matches::where(['recipient'=>$request->initiator,'initator'=>$request->recipient])->first();

            if ($match_confirmation->confirmed=="1") {
                return response()->json([
                    'status'=>'info',
                    'message'=>'Its a match!'
                ]);
            }else{            
                return response()->json([
                    'status'=>'info',
                    'message'=>$username. ' has already send you a match request, check your notification bar to confirm it'
                ]);
            }

        }
        if (!empty($request->initiator)&&!empty($request->recipient)) {

            if (Matches::where(['initator'=>$request->initiator,'recipient'=>$request->recipient])->first()) {

                $confirmed= Matches::where(['initator'=>$request->initiator,'recipient'=>$request->recipient])->first()->confirmed;

                if ($confirmed==0) {
                    return response()->json([
                        'status'=>'info',
                        'data'=>0,
                        'message'=>'Match request already sent!,Waiting confirmation'
                    ]);
                }else{
                    return response()->json([
                        'status'=>'info',
                        'data'=>1,
                        'message'=>'Match request already sent!'
                    ]);
                }
            }
            $match =new Matches();

            $match->initator =(int) $request->initiator;
            $match->recipient =(int) $request->recipient;
            $match->confirmed =false;
            if ($match->save()) {
                $initiator_name = User::where('id',$request->initiator)->first()->username;
                $recipient_name = User::where('id',$request->recipient)->first()->username;

                $notification = new Notification;

                $notification->user_id = (int) $request->recipient;

                $notification->description = $initiator_name." sent you a match request";

                $notification->status ="unread";
                $notification->type ="match_request";
                $notification->extra_info =$match->id;

                $notification->save();

                $recipient_email =User::where('id',$request->recipient)->first()->email;

                if (!empty($recipient_email)) {
                    # code...
                    try {
                        Mail::to($recipient_email)->queue(
                            new MatchNotification($initiator_name,$recipient_name)
                        );

                    } catch (\Exception $e) {
                        // return $e->getMessage();
                    }
                }
                return response()->json([
                    'status'=>'success',
                    'message'=>'Match request sent!'
                ]);
            }else{
                return response()->json([
                    'status'=>'info',
                    'message'=>'An error occured ,try again later'
                ]);
            }

        }else{
            return response()->json([
                'status'=>'info',
                'message'=>'An error occured ,try again later'
            ]);
        }
    }


    public function sendMessage(Request $request){
        $validator =Validator::make($request->all(),[
          'message' => 'required',
          'receiver_id' => 'required',
          'sender_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>'info',
                'message'=>$validator->errors()->all()
            ]);
        }else{


            $conditionOne=Conversation::where(['person_one'=>$request->sender_id,'person_two'=>$request->receiver_id])->exists();
            $conditionTwo=Conversation::where(['person_two'=>$request->sender_id,'person_one'=>$request->receiver_id])->exists();

            $conversationId=null;

            if ($conditionOne) {
                $conversationId = Conversation::where(['person_one'=>$request->sender_id,'person_two'=>$request->receiver_id])->first()->id;
            }else if($conditionTwo){
                $conversationId = Conversation::where(['person_two'=>$request->sender_id,'person_one'=>$request->receiver_id])->first()->id;
            }else{
                //create new conversation list;
                $conversation = new Conversation();

                //person_one will always be our sender
                $conversation->person_one= $request->sender_id;

                //person_two will always be our receiver
                $conversation->person_two= $request->receiver_id;

                $conversation->save();

                $conversationId = $conversation->id;

            }


            if ($conversationId!==null) {

                
                # code...
                $message = new Message();
                $message->conversation_id=$conversationId;
                $message->user_id=$request->sender_id;
                $message->account_type="member";
                $message->read_status="unread";
                $message->text=$request->message;

                if ($message->save()) {

                    //return the message information with receiver informations
                    $user_conversations = Message::with(['user'=>function($query){
                        $query->select('id','username');
                    }])
                    ->where(['conversation_id'=>$conversationId])
                    ->orderBy('id', 'DESC')
                    ->get(); 

                        $initiator_name = User::where('id',$request->sender_id)->first()->username;

                        $recipient_name = User::where('id',$request->receiver_id)->first()->username;

                        $receiver_email = User::where('id',$request->receiver_id)->first()->email;


                        $notification = new Notification;

                        $notification->user_id = (int) $request->receiver_id;

                        $notification->description = $initiator_name." sent you a message.";

                        $notification->save();

                        try {
                            Mail::to($receiver_email)->queue(
                                new MessageNotification($initiator_name,$recipient_name)
                            );

                        } catch (\Exception $e) {
                            return $e->getMessage();
                            // return response()->json([
                            //     'status'=>'info',
                            //     'message'=>'Action failed ,Try again later!'
                            // ]);
                        }
                    
                    return response()->json([
                        'status'=>'success',
                        'message'=>'Message sent',
                        'user_conversation' =>$user_conversations
                    ]);
                }else{
                    return response()->json([
                        'status'=>'info',
                        'message'=>'Error occurred , try again later.'
                    ]);
                }

            }else{
                    return response()->json([
                        'status'=>'info',
                        'message'=>'Error occurred , try again later.'
                    ]);
            }



        }
        return $request->all();
    }

    public function getUserConverations($request){

        // return $request;

                $caseOne= Matches::where([
                    'initator'=>$request['sender_id'],
                    'recipient'=>$request['receiver_id'],
                ])->first();

                $caseTwo= Matches::where([
                    'recipient'=>$request['sender_id'],
                    'initator'=>$request['receiver_id'],
                ])->first();

                 // return gettype($caseOne);

                $match_confirmation= $caseOne!==null ? $caseOne : ($caseTwo!==null ? $caseTwo : null) ; 

                $conversation_list=null;
                $confirmed="false";

                $match_request_status="not_available";

                if ($match_confirmation!==null && $match_confirmation->confirmed =="1") {


                    
                    $conditionOne =Conversation::where(['person_one'=>$request['sender_id'],'person_two'=>$request['receiver_id']])->exists();
                    $conditionTwo =Conversation::where(['person_two'=>$request['sender_id'],'person_one'=>$request['receiver_id']])->exists();

                    if ($conditionOne) {
                        $conversation_list =Conversation::with(['messages.user'])->where(['person_one'=>$request['sender_id'],'person_two'=>$request['receiver_id']])->first()->messages;
                    }else if($conditionTwo){
                        $conversation_list =Conversation::with(['messages.user'])->where(['person_two'=>$request['sender_id'],'person_one'=>$request['receiver_id']])->first()->messages;
                    }else{
                        $conversation_list=[];
                    }
                    # code...

                    // return $conversation_list;

                    // $user_conversations = Message::with(['receiver_info'])
                    // ->where(['sender'=>$request['sender_id'],'receiver'=>$request['receiver_id']])
                    // ->orWhere(['receiver'=>$request['sender_id'],'sender'=>$request['receiver_id']])
                    // ->orderBy('id', 'DESC')
                    // ->get();

                    $confirmed="true";
                    $match_request_status="confirmed";
                }

                if (!empty($match_confirmation) && $match_confirmation->confirmed =="0") {
                    # code...

                    $match_request_status="pending";
                }



                // $user_conversations=(array) $conversation_list;


                $arr= !empty($conversation_list) ?  array_reverse($conversation_list->toArray()) : [];
                return response()->json([
                    'user_conversations'=>$arr,
                    'confirmed'=>$confirmed,
                    'match_request_status'=>$match_request_status
                ]);

    }
    public function getUserChats(Request $request){

        return $this->getUserConverations($request);
    }

    public function clearNotifications(Request $request){
        if (!empty($request->user_id)) {

            $update=Notification::where('user_id',$request->user_id)->update([
                'status'=>"read"
            ]);

            if ($update) {
                return response()->json([
                    'status'=>'success',
                    'message'=>'Notifications successful cleared'
                ]);
            }else{
                return response()->json([
                    'status'=>'info',
                    'message'=>'Update was unsuccessful!'
                ]);
            }


        }else{
            return response()->json([
                'status'=>'info',
                'message'=>'An error occured ,try again later'
            ]);
        }
    }

    public function ConfirmMatch(Request $request){


        $notification_type=$request->notification_type;

        $notification_id=$request->notification_id;

        $match_id=$request->match_id;

        // return Matches::with(['initiator','recipient'])->where("id",$match_id)->first();

        $exception = DB::transaction(function () use ($notification_type,$notification_id,$match_id) {
            try {
                Notification::where("id",$notification_id)->update(['extra_info'=>"confirmed"]);

                Matches::where("id",$match_id)->update(['confirmed'=>"1"]);

                $parties = Matches::with(['initiator','recipient_info'])->where("id",$match_id)->first();

                $recipient_name=$parties->recipient_info->username;

                $initiator_id=$parties->initiator->id;


                $notification = new Notification;

                $notification->user_id = (int) $initiator_id;

                $notification->description = $recipient_name." confirmed your match request!";

                $notification->status ="unread";

                $notification->save();

            } catch (Exception $e) {
            }
        });

        if (is_null($exception)) {
            return response()->json([
                'message' => 'Match confirmed Successfully!',
                'status' => 'success',
                "user_id" => Matches::where("id",$match_id)->exists() ? Matches::where("id",$match_id)->first()->initator : null
            ]);
        } else {
            return response()->json([
                'message' => 'Match confirmation failed , contact admin for support!',
                'status' => 'info',
            ]);
        }
    }

    public function fetchUserInformation(Request $request){

        if(empty($request->user_id)) return response()->json(['message' => 'Error occured , try again later!', 'status' => 'info',]);


        if (User::where('id',$request->user_id)->exists()) {
            $user =User::where('id',$request->user_id)->first();

            return response()->json([
                'message' => '',
                'data'=>$user,
                'status' => 'info',
            ]);

        }else{
            return response()->json([
                'message' => 'User not found,try again later',
                'status' => 'info',
            ]);
        }
    }

    public function searchWithUsername(Request $request){

        if (empty($request->key)) {
            return response()->json([
                'message' => 'No results found',
                'status' => 'info',
            ]);
        }
        $data = User::where('username',$request->key)
                ->orWhere('username','like', '%'.$request->key.'%')->get();



        return response()->json([
            'message' => 'Available results',
            'data'=>$data,
            'status' => 'success',
        ]);


    }

    public function advancedSearch(Request $request){

        if ($request->isMethod('GET')) {
            if (!Auth::check()) {
                return redirect()->route('user-login')->with([
                    'status'=>'info',
                    'message'=>'Login to proceed!'
                ]); 
            }
            $hair_lengths = HairLength::all();
            $hair_colors = HairColor::all();
            $countries = Countries::all();
            $hair_types = HairType::all();
            $eye_colors =EyeColor::all();
            $eye_wears =EyeWear::all();
            return view('user.search', compact('countries','hair_types','hair_colors','hair_lengths','eye_colors','eye_wears'));
        }
    }
}
