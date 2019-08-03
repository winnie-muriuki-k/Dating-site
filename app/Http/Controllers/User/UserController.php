<?php

namespace App\Http\Controllers\User;

use App\Admin\Gender;
use App\Favourite;
use App\Http\Controllers\BaseController;
use App\View;
use Illuminate\Support\Facades\Route;
use App\BeautyLevels;
use App\BestFeature;
use App\BodyArt;
use App\BodyType;
use App\Cities;
use App\Complexion;
use App\Countries;
use App\DrinkingStatus;
use App\Ethnicity;
use App\EyeColor;
use App\EyeWear;
use App\FacialHairTypes;
use App\Food;
use App\HairColor;
use App\HairLength;
use App\HairType;
use App\Height;
use App\Hobby;
use App\Motive;
use App\MusicType;
use App\Profile;
use App\SmokingStatus;
use App\ProfileVisit;
use App\Sport;
use App\UserFood;
use App\UserHobby;
use App\UserMusicType;
use App\UserSport;
use App\Weight;
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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Hash;
use Auth;
use Illuminate\Routing\Redirector;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // protected $user; 

    public function __construct(){
        
       $this->middleware('email-verification')->only(['update_avatar','profile',
        'editProfile','editInterests','dashboard','MatchUser','interests','interested']);
      $exemptedMethods=['login','passwordReset','register','resetToken','PasswordResetReal','UserLogout'];
      $this->middleware('email-verification')->except($exemptedMethods);
      $this->middleware('auth')->except($exemptedMethods);

    } 


    public function login(Request $request)
    {
        if($request->isMethod('GET')){
            if (Auth::check()) return redirect('/');
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

    public function view($id)
    {

        $user_id=Auth::user()->id;
        if(!View::where(['viewer'=>$user_id, 'recipient'=>$id])->exists()){
            $view = new View();
            $view->viewer = $user_id;
            $view->recipient = $id;
            $view->save();
        }

        $interest_recent_activity = Matches::where(['recipient'=>Auth::user()->id,'confirmed'=>'0'])->where('initator', '!=', Auth::user()->id )->latest()->limit(6)->get();

        $new_favourites = Favourite::where(['recipient_id'=>$user_id, 'status'=>0])->get();

        $notifications = Notification::where(['user_id'=>$user_id,'status'=>'unread'])->get();

        $all_notifications = Notification::where(['user_id'=>$user_id])->orderBy('id', 'DESC')->get();
        $recent_activity = Favourite::where(['recipient_id'=>Auth::user()->id])->latest()->limit(6)->get();

        $unread_messages =Message::where(['receiver_id'=>$user_id,'read_status'=>'read'])->get();
        $users= User::with(['match'])->where(['role'=>'customer'])->where('id','!=',$user_id)->paginate(15);
        $user = User::where("id",$id)->first();
       // return $user;
        return view('user.view',  compact('interest_recent_activity','user','recent_activity','new_favourites','unread_messages','notifications','all_notifications', 'users'));
    }

    public function profile ()
    {
        $user_id=Auth::user()->id;
        $interest_recent_activity = Matches::where(['recipient'=>Auth::user()->id,'confirmed'=>'0'])->where('initator', '!=', Auth::user()->id )->latest()->limit(6)->get();

        $notifications = Notification::where(['user_id'=>$user_id,'status'=>'unread'])->get();

        $all_notifications = Notification::where(['user_id'=>$user_id])->orderBy('id', 'DESC')->get();

        $unread_messages =Message::where(['receiver_id'=>$user_id,'read_status'=>'read'])->get();
        $new_favourites = Favourite::where(['recipient_id'=>$user_id, 'status'=>0])->get();
        $recent_activity = Favourite::where(['recipient_id'=>Auth::user()->id])->latest()->limit(6)->get();

        $users= User::with(['match'])->where(['role'=>'customer'])->where('id','!=',$user_id)->paginate(15);

        return view('user.profile', compact('interest_recent_activity','recent_activity','unread_messages','new_favourites','notifications','all_notifications', 'users'));
    }

    public function settings ()
    {
        $user_id=Auth::user()->id;
        $interest_recent_activity = Matches::where(['recipient'=>Auth::user()->id,'confirmed'=>'0'])->where('initator', '!=', Auth::user()->id )->latest()->limit(6)->get();

        $notifications = Notification::where(['user_id'=>$user_id,'status'=>'unread'])->get();

        $all_notifications = Notification::where(['user_id'=>$user_id])->orderBy('id', 'DESC')->get();

        $unread_messages =Message::where(['receiver_id'=>$user_id,'read_status'=>'read'])->get();
        $new_favourites = Favourite::where(['recipient_id'=>$user_id, 'status'=>0])->get();
        $recent_activity = Favourite::where(['recipient_id'=>Auth::user()->id])->latest()->limit(6)->get();

        $users= User::with(['match'])->where(['role'=>'customer'])->where('id','!=',$user_id)->paginate(15);

        return view('user.settings', compact('interest_recent_activity','recent_activity','unread_messages','new_favourites','notifications','all_notifications', 'users'));
    }

    public function passwordReset(Request $request){
        if ($request->isMethod('GET')) {
            if (Auth::check()) return redirect('/');
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
                'username' => 'required|unique:users|max:255',
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
            if (Auth::check()) return redirect('/');
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
        $user_id=Auth::user()->id;
        $new_favourites = Favourite::where(['recipient_id'=>$user_id, 'status'=>0])->get();
        $interest_recent_activity = Matches::where(['recipient'=>Auth::user()->id,'confirmed'=>'0'])->where('initator', '!=', Auth::user()->id )->latest()->limit(6)->get();

        $notifications = Notification::where(['user_id'=>$user_id,'status'=>'unread'])->get();
        $all_notifications = Notification::where(['user_id'=>$user_id])->orderBy('id', 'DESC')->get();
        $unread_messages =Message::where(['receiver_id'=>$user_id,'read_status'=>'read'])->get();
        $hair_lengths = HairLength::all();
        $hair_colors = HairColor::all();
        $countries = Countries::all();
        $hair_types = HairType::all();
        $eye_colors =EyeColor::all();
        $eye_wears =EyeWear::all();
        $gender =Gender::all();
        $heights =Height::all();
        $weights =Weight::all();
        $body_types = BodyType::all();
        $ethnicities = Ethnicity::all();
        $complexions = Complexion::all();
        $facial_hair_types = FacialHairTypes::all();
        $best_features = BestFeature::all();
        $body_arts = BodyArt::all();
        $beauty_levels = BeautyLevels::all();
        $drinking_statuses = DrinkingStatus::all();
        $smoking_statuses = SmokingStatus::all();
        $hobbies = Hobby::all();
        $foods = Food::all();
        $music_types = MusicType::all();
        $sports = Sport::all();

        if ($request->isMethod('POST')) {

                $user = Auth::user();
                if(!is_null($user->profile_id)){
                    $profile_model = Profile::where(['id'=> $user->profile_id])->first();
                }else{
                    $profile_model = new Profile();
                }
                //return $request->all();

                $userInfo = Auth::user();
                if ($request->has('profile_image')) {
                    // Get image file
                    $avatar = $request->file('profile_image');
                    $filename = time() . '.' . $avatar->getClientOriginalExtension();
                    Image::make($avatar)->resize(300, 300)->save( public_path().'/avatars/'. $filename);
                    $userInfo->avatar = $filename;
                }
                $userInfo->gender = $request->gender;
                $userInfo->dob = $request->dob;
                $userInfo->seeking_id = $request->seeking_id;
                $userInfo->save();

                $user->dob = $request->dob;
                $profile_model->user_id = Auth::user()->id;
                $profile_model->country_id = $request->country;
                //TODO add cities to db
                $profile_model->city_id = 1;
                $profile_model->hair_color_id = $request->hair_color;
                $profile_model->hair_type_id = $request->hair_type;
                $profile_model->facial_hair_type_id = $request->facial_hair_type;
                $profile_model->hair_length_id = $request->hair_length;
                $profile_model->eye_color_id = $request->eye_color;
                $profile_model->eye_wear_id = $request->eye_wear;
                $profile_model->height_id = $request->height;
                $profile_model->weight_id = $request->weight;
                $profile_model->body_type_id = $request->body_type;
                $profile_model->ethnicity_id = $request->ethnicity;
                $profile_model->complexion_id = $request->complexion;
                $profile_model->best_feature_id = $request->best_feature;
                $profile_model->body_art_id = $request->body_art;
                $profile_model->beauty_level_id = $request->beauty_level;


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



        }else if ($request->isMethod('GET')) {


            $userProfile= Profile::where('user_id' ,$user_id)->first();

            $user_music_types =  Auth::user()->music;
            $music_id_array = array();
            if(!empty($user_music_types)){
                foreach ($user_music_types as $music_type){
                    array_push($music_id_array, $music_type->music_id);
                }
            }
            $user_hobbies =  Auth::user()->hobbies;
            $hobbies_id_array = array();
            if(!empty($user_hobbies)){
                foreach ($user_hobbies as $hobby){
                    array_push($hobbies_id_array, $hobby->hobby_id);
                }
            }
            $user_foods =  Auth::user()->foods;
            $food_id_array = array();
            if(!empty($user_foods)){
                foreach ($user_foods as $food){
                    array_push($food_id_array, $food->food_id);
                }
            }

            $user_sports =  Auth::user()->sports;
            $sports_id_array = array();
            if(!empty($user_sports)){
                foreach ($user_sports as $sport){
                    array_push($sports_id_array, $sport->sport_id);
                }
            }
            $recent_activity = Favourite::where(['recipient_id'=>Auth::user()->id])->latest()->limit(6)->get();
            return view('user.edit-profile', compact(
                'facial_hair_types','complexions','beauty_levels','body_arts','best_features','gender',
                'ethnicities','body_types','weights','heights','eye_wears','eye_colors',
                'hair_types','hair_lengths','hair_colors','unread_messages','notifications',
                'all_notifications','countries','drinking_statuses', 'smoking_statuses',
                'music_types','userProfile', 'hobbies','foods', 'sports', 'music_id_array', 'food_id_array', 'sports_id_array'
                ,'hobbies_id_array','new_favourites','recent_activity','interest_recent_activity'
            ));
        }else{
            return response()->json([
                'status'=>'info',
                'message'=>'invalid request method'
            ]);
        }
    }

    public function editInterests(Request $request)
    {
        if (!is_null($request->hobbies)){
            $hobbies = $request->hobbies;
            $hobbies_array = explode(',',$hobbies);
           foreach ($hobbies_array as $key=>$value){
               $user_hobbies =  Auth::user()->hobbies;
               $hobbies_id_array = array();
               if(!empty($user_hobbies)){
                   foreach ($user_hobbies as $hobby){
                       array_push($hobbies_id_array, $hobby->hobby_id);
                   }
               }
               if ($value != '' && !in_array($value,$hobbies_id_array)){
                   $hobby_name = Hobby::where(['id'=>$value])->value('name');
                   $user_id = Auth::user()->id;
                   $user_hobby = new UserHobby();
                   $user_hobby->user_id = $user_id;
                   $user_hobby->hobby_name = $hobby_name;
                   $user_hobby->hobby_id = $value;
                   $user_hobby->save();
               }else{
                   continue;
               }
           }

        }
        if (!is_null($request->music)){
            $music_types = $request->music;
            $music_types_array = explode(',',$music_types);
            foreach ( $music_types_array as $key=>$value){
                $user_music_types =  Auth::user()->music;
                $music_id_array = array();
                if(!empty($user_music_types)){
                    foreach ($user_music_types as $music_type){
                        array_push($music_id_array, $music_type->music_id);
                    }
                }
                if ($value != '' && !in_array($value,$music_id_array)){
                    $music_name = MusicType::where(['id'=>$value])->value('name');
                    $user_id = Auth::user()->id;
                    $user_music_type = new UserMusicType();
                    $user_music_type->user_id = $user_id;
                    $user_music_type->music_name = $music_name;
                    $user_music_type->music_id = $value;
                    $user_music_type->save();
                }else{
                    continue;
                }
            }

        }

        if (!is_null($request->foods)){
            $foods = $request->foods;
            $food_array = explode(',',$foods);
            foreach ( $food_array as $key=>$value){
                $user_foods =  Auth::user()->foods;
                $food_id_array = array();
                if(!empty($user_foods)){
                    foreach ($user_foods as $food){
                        array_push($food_id_array, $food->food_id);
                    }
                }
                if ($value != '' && !in_array($value,$food_id_array)){
                    $food_name = Food::where(['id'=>$value])->value('name');
                    $user_id = Auth::user()->id;
                    $user_food = new UserFood();
                    $user_food->user_id = $user_id;
                    $user_food->food_name = $food_name;
                    $user_food->food_id = $value;
                    $user_food->save();
                }else{
                    continue;
                }
            }

        }

        if (!is_null($request->sports)){
            $sports = $request->sports;
            $sports_array = explode(',',$sports);
            foreach ( $sports_array as $key=>$value){
                $user_sports =  Auth::user()->sports;
                $sports_id_array = array();
                if(!empty($user_sports)){
                    foreach ($user_sports as $sport){
                        array_push($sports_id_array, $sport->sport_id);
                    }
                }
                if ($value != '' && !in_array($value,$sports_id_array)){
                    $sport_name = Sport::where(['id'=>$value])->value('name');
                    $user_id = Auth::user()->id;
                    $user_sport = new UserSport();
                    $user_sport->user_id = $user_id;
                    $user_sport->sport_name = $sport_name;
                    $user_sport->sport_id = $value;
                    $user_sport->save();
                }else{
                    continue;
                }
            }

        }

        return  response()->json([
            'status'=>'success',
            'message'=>'Your interests and hobbies have been saved successfully'
        ]);

    }

    public function favourited ($id)
    {
        $user_id=Auth::user()->id;

        Favourite::where(['recipient_id'=>$user_id])->update(['status'=>1]);
        $interest_recent_activity = Matches::where(['recipient'=>Auth::user()->id,'confirmed'=>'0'])->where('initator', '!=', Auth::user()->id )->latest()->limit(6)->get();

        $notifications = Notification::where(['user_id'=>$user_id,'status'=>'unread'])->get();

        $all_notifications = Notification::where(['user_id'=>$user_id])->orderBy('id', 'DESC')->get();

        $unread_messages =Message::where(['receiver_id'=>$user_id,'read_status'=>'read'])->get();
        $new_favourites = Favourite::where(['recipient_id'=>$user_id, 'status'=>0])->get();
        $favourites = Auth::user()->myFavourites;
        $favourited = Favourite::where(['recipient_id'=>$user_id])->paginate(5);
        $recent_activity = Favourite::where(['recipient_id'=>Auth::user()->id])->latest()->limit(6)->get();
        $fav_id_array = array();
        if(!empty($favourites)){
            foreach ($favourites as $fav){
                array_push($fav_id_array, $fav->recipient_id);
            }

        }

        return view('user.favourited', compact('recent_activity','interest_recent_activity','fav_id_array','favourited','unread_messages','new_favourites','notifications','all_notifications', 'users'));

    }

    public function favourites ()
    {
        $user_id=Auth::user()->id;

        $notifications = Notification::where(['user_id'=>$user_id,'status'=>'unread'])->get();
        $interest_recent_activity = Matches::where(['recipient'=>Auth::user()->id,'confirmed'=>'0'])->where('initator', '!=', Auth::user()->id )->latest()->limit(6)->get();

        $all_notifications = Notification::where(['user_id'=>$user_id])->orderBy('id', 'DESC')->get();

        $unread_messages =Message::where(['receiver_id'=>$user_id,'read_status'=>'read'])->get();
        $new_favourites = Favourite::where(['recipient_id'=>$user_id, 'status'=>0])->get();
        $favourites = Auth::user()->myFavourites;
        $favourited = Favourite::where(['initiator_id'=>$user_id])->paginate(5);
        $recent_activity = Favourite::where(['recipient_id'=>Auth::user()->id])->latest()->limit(6)->get();
        $fav_id_array = array();
        if(!empty($favourites)){
            foreach ($favourites as $fav){
                array_push($fav_id_array, $fav->recipient_id);
            }

        }

        return view('user.my-favourites', compact('recent_activity','interest_recent_activity','fav_id_array','favourited','unread_messages','new_favourites','notifications','all_notifications', 'users'));


    }

    public function addFav(Request $request)
    {
        if(!empty($request->fav) && !empty($request->user))
        {
            $fav = new Favourite();
            $fav->initiator_id = $request->user;
            $fav->recipient_id = $request->fav;
            $fav_name = User::where(['id'=>$request->fav])->value('username');
            if($fav->save()){
                return  response()->json([
                    'status'=>'success',
                    'message'=>$fav_name .' has been added to your favourites'
                ]);
            }else{
                return  response()->json([
                    'status'=>'error',
                    'message'=>'Error adding '.$fav_name .' to your favourite. Please Try again later'
                ]);
            }
        }else{
            return  response()->json([
                'status'=>'error',
                'message'=>'Error adding '.$fav_name .' to your favourite. Please Try again later'
            ]);

        }
    }


    public function dashboard(){
        // return "dashboard";
        if (Auth::user()->role=="customer") {
            $user_id=Auth::user()->id;
            $recent_activity = Favourite::where(['recipient_id'=>Auth::user()->id])->latest()->limit(6)->get();
            //$confirmed_recent_activity =  Matches::where(['initator'=>Auth::user()->id,'confirmed'=>'1'])->where('recipient', '!=', Auth::user()->id )->latest()->limit(6)->get();

            $interest_recent_activity = Matches::where(['recipient'=>Auth::user()->id,'confirmed'=>'0'])->where('initator', '!=', Auth::user()->id )->latest()->limit(6)->get();
            //return $interest_recent_activity;
            //return $recent_activity;
            $new_favourites = Favourite::where(['recipient_id'=>$user_id, 'status'=>0])->get();
            $favourites = Auth::user()->myFavourites;
            $fav_id_array = array();
            if(!empty($favourites)){
                foreach ($favourites as $fav){
                    array_push($fav_id_array, $fav->recipient_id);
                }

            }

            $visitorsCount = ProfileVisit::where('user_id',$user_id)->exists() ?ProfileVisit::where('user_id',$user_id)->first()->count : "0";

            $seeking =!empty(Auth::user()->seeking) ?  Auth::user()->seeking->name : null;

            $notifications = Notification::where(['user_id'=>$user_id,'status'=>'unread','type'=>'match_request'])->get();

            $all_notifications = Notification::where(['user_id'=>$user_id])->orderBy('id', 'DESC')->get();

            $unread_messages =Conversation::with(['messages'])
            ->where(['person_one'=>$user_id])
            ->orWhere(['person_two'=>$user_id])->get();

            //$currentPath= Route::getFacadeRoot()->current()->uri();
           // return $currentPath;

            $users = !empty($seeking) && User::with(['match'])
                                        ->where(['role'=>'customer'])
                                        ->where('id','!=',$user_id)
                                        ->where('gender' ,$seeking)
                                        ->exists()
                                         ? User::with(['match'])
                                        ->where(['role'=>'customer'])
                                        ->where('id','!=',$user_id)
                                        ->where('gender' ,$seeking)
                                        ->paginate(15) :
            User::with(['match'])->where(['role'=>'customer'])->where('id','!=',$user_id)->paginate(15);

            return view('user.dashboard',compact('interest_recent_activity','recent_activity','fav_id_array','new_favourites','users','visitorsCount','unread_messages','notifications','all_notifications'));
        }
        if (Auth::user()->role=="admin") {
            # code...
        }
        
    }


    public function resetToken($token){
        if (Auth::check()) return redirect('/');
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
        //return $request->all();
    }

    public function PasswordResetReal(Request $request){
        // if (Auth::check()) return redirect('/');
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
                $match->notification_id = $notification->id;
                $match->save();

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

    public function interests($id)
    {

        if (Auth::user()->role=="customer") {
            $user_id=Auth::user()->id;
               $interests = Matches::with('user_recipient')->where(['initator'=>$id])->where('recipient', '!=', $user_id)->paginate(3);
               // return gettype($interests);

            $interest_recent_activity = Matches::where(['recipient'=>Auth::user()->id,'confirmed'=>'0'])->where('initator', '!=', Auth::user()->id )->latest()->limit(6)->get();

            $notifications = Notification::where(['user_id'=>$user_id,'status'=>'unread'])->get();
            $new_favourites = Favourite::where(['recipient_id'=>$user_id, 'status'=>0])->get();
            $recent_activity = Favourite::where(['recipient_id'=>Auth::user()->id])->latest()->limit(4)->get();

            $all_notifications = Notification::where(['user_id'=>$user_id])->orderBy('id', 'DESC')->get();

            $unread_messages =Conversation::with(['messages'])
                ->where(['person_one'=>$user_id])
                ->orWhere(['person_two'=>$user_id])->get();


            return view('user.interests',compact('interest_recent_activity','recent_activity','users','new_favourites','interests', 'unread_messages','notifications','all_notifications'));
        }
        if (Auth::user()->role=="admin") {
            # code...
        }
    }
    public function interested($id)
    {
        if (Auth::user()->role=="customer") {
            $user_id=Auth::user()->id;
            $interest_recent_activity = Matches::where(['recipient'=>Auth::user()->id,'confirmed'=>'0'])->where('initator', '!=', Auth::user()->id )->latest()->limit(6)->get();
            $interests = Matches::with('user_recipient')->where(['recipient'=>$id])->where('initator', '!=', $user_id)->paginate(3);
            // return gettype($interests);

            $notifications = Notification::where(['user_id'=>$user_id,'status'=>'unread'])->get();
            $new_favourites = Favourite::where(['recipient_id'=>$user_id, 'status'=>0])->get();
            $recent_activity = Favourite::where(['recipient_id'=>Auth::user()->id])->latest()->limit(6)->get();

            $all_notifications = Notification::where(['user_id'=>$user_id])->orderBy('id', 'DESC')->get();

            $unread_messages =Conversation::with(['messages'])
                ->where(['person_one'=>$user_id])
                ->orWhere(['person_two'=>$user_id])->get();


            return view('user.interested_in_me',compact('recent_activity','interest_recent_activity','users','new_favourites','interests', 'unread_messages','notifications','all_notifications'));
        }
        if (Auth::user()->role=="admin") {
            # code...
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
                $message->sender_id=$request->sender_id;
                $message->receiver_id=$request->receiver_id;
                $message->account_type="member";
                $message->read_status="unread";
                $message->text=$request->message;

                if ($message->save()) {

                    Conversation::where("id",$conversationId)->update(['updated_at'=>Carbon::now()]);

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



                        try {
                            Mail::to($receiver_email)->queue(
                                new MessageNotification($initiator_name,$recipient_name)
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


                $caseOne= Matches::where([
                    'initator'=>$request['sender_id'],
                    'recipient'=>$request['receiver_id'],
                ])->first();

                $caseTwo= Matches::where([
                    'recipient'=>$request['sender_id'],
                    'initator'=>$request['receiver_id'],
                ])->first();



                $match_confirmation= $caseOne!==null ? $caseOne : ($caseTwo!==null ? $caseTwo : null) ; 

                $conversation_list=null;
                $confirmed="false";

                $match_request_status="not_available";
                
                $conditionOne =Conversation::where(['person_one'=>$request['sender_id'],'person_two'=>$request['receiver_id']])->exists();
                $conditionTwo =Conversation::where(['person_two'=>$request['sender_id'],'person_one'=>$request['receiver_id']])->exists();

                if ($conditionOne) {
                    $conversation_list =Conversation::with(['messages.user'])->where(['person_one'=>$request['sender_id'],'person_two'=>$request['receiver_id']])->first()->messages;
                }else if($conditionTwo){
                    $conversation_list =Conversation::with(['messages.user'])->where(['person_two'=>$request['sender_id'],'person_one'=>$request['receiver_id']])->first()->messages;
                }else{
                    $conversation_list=[];
                }

                if ($match_confirmation!==null && $match_confirmation->confirmed =="1") {                    

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


            if(!ProfileVisit::where("user_id",$request->user_id)->exists()){
                ProfileVisit::where("user_id",$request->user_id)->create([
                    'user_id'=>$request->user_id,
                    'count'=>'1'
                ]);
            }else{
                $count=(int) ProfileVisit::where("user_id",$request->user_id)->first()->count;

                $updatedCount=$count+1;

                ProfileVisit::where("user_id",$request->user_id)->update(['count'=>$updatedCount]);


            }
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

    public function search(Request $request){

        if($request->is_advanced_search == 0){
            $data = User::with('profile')->where([
                ['gender', '=', $request->looking_for],
                ['age', '>=', $request->age_starting],
                ['age', '<=', $request->age_ending],
            ])->whereHas('profile', function($q) use ($request){
              $q->where(
                  ['country_id'=>$request->living_in_country]

              );
            })->get();

            return response()->json([
                'message' => 'Available results',
                'data'=>$data,
                'status' => 'success',
            ]);
            }else if($request->is_advanced_search == 1){
            $data = User::with('profile')->where([
                ['gender', '=', $request->looking_for],
                ['age', '>=', $request->age_starting],
                ['age', '<=', $request->age_ending],
                ['age', '<=', $request->age_ending],
            ])->whereHas('profile', function($q) use ($request){
                $q->where('country_id', $request->living_in_country);
            })->get();

            return response()->json([
                'message' => 'Available results',
                'data'=>$data,
                'status' => 'success',
            ]);

            }
    }

    public function searchWithUsername(Request $request){



    }

    public function advancedSearch(Request $request){

        if ($request->isMethod('GET')) {
            $user_id = Auth::user()->id;
            $hair_lengths = HairLength::all();
            $hair_colors = HairColor::all();
            $countries = Countries::all();
            $hair_types = HairType::all();
            $eye_colors =EyeColor::all();
            $eye_wears =EyeWear::all();
            $genders = Gender::all();
            $motives = Motive::all();
            $cities = Cities::all();
            $interest_recent_activity = Matches::where(['recipient'=>Auth::user()->id,'confirmed'=>'0'])->where('initator', '!=', Auth::user()->id )->latest()->limit(6)->get();
            $new_favourites = Favourite::where(['recipient_id'=>$user_id, 'status'=>0])->get();
            $recent_activity = Favourite::where(['recipient_id'=>Auth::user()->id])->latest()->limit(6)->get();
            return view('user.search', compact('recent_activity','interest_recent_activity','new_favourites','countries','cities','motives','genders','hair_types','hair_colors','hair_lengths','eye_colors','eye_wears'));
        }
    }


    public function userMessages(Request $request){

        if ($request->isMethod('GET')) {
            $user_id =Auth::user()->id;
            $new_favourites = Favourite::where(['recipient_id'=>$user_id, 'status'=>0])->get();
            $recent_activity = Favourite::where(['recipient_id'=>Auth::user()->id])->latest()->limit(6)->get();
            $interest_recent_activity = Matches::where(['recipient'=>Auth::user()->id,'confirmed'=>'0'])->where('initator', '!=', Auth::user()->id )->latest()->limit(6)->get();


            $userChats=  Conversation::with(['messages.senderPerson'=>function($query){
                $query->select('id','username');
            },'messages.receiverPerson'=>function($query){
                $query->select('id','username');
            }])
            ->where('person_two','=',$user_id)
            ->orWhere('person_one','=',$user_id)->orderBy('updated_at', 'DESC')->get();


            return view('user.messages',compact('userChats','new_favourites','interest_recent_activity','recent_activity'));
        }
    }

    public function deleteUserConversations(Request $request){
        $conversation_ids=$request->conversation_ids;
        if (count($request->conversation_ids)>0) {
                $exception = DB::transaction(function () use ($conversation_ids) {
                    try {
                        foreach ($conversation_ids as $id) {
                            Conversation::where("id",$id)->delete();
                            Message::where("conversation_id",$id)->delete();
                        }
                        
                    } catch (Exception $e) {
                    }
                });

                if (is_null($exception)) {
                    return response()->json([
                        'message' => 'Conversation successfully deleted!',
                        'status' => 'success',
                    ]);
                } else {
                    return response()->json([
                        'message' => 'Error occured please try again later',
                        'status' => 'info',
                    ]);
                }
        }else{
            return response()->json([
                'message' => 'Select atleast one conversation to delete.',
                'status' => 'info',
            ]);
        }

    }

    public function updateMessagesReadStatus(Request $request){
        if(!empty($request->conversation_id)){

            $update =Message::where(['conversation_id'=>$request->conversation_id,'receiver_id'=>$request->logged_in_user_id])->update(['read_status'=>'read']);
            return $update;
        }
    }
}
