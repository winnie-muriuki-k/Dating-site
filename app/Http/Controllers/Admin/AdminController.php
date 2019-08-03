<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\User;
use App\BlockedUser;
use App\Admin\Role;
use DB;
use App\Mail\UserBanNotification;
use Hash;
use Mail;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        $roles=Role::all();
        return view('admin.dashboard',compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Admins(Request $request)
    {
        if ($request->isMethod('GET')) {
           return view('admin.admin');
        }
    }

    public function login(){
        if (Auth::check() && Auth::user()->role=="admin") {
            return redirect()->route('admin-dashboard');
        }
        return view('admin.login');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Members(Request $request)
    {
        if ($request->isMethod('GET')) {
           return view('admin.members');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function processLogin(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'email'=>'required',
            'password'=>'required'
        ]);
        // return $request->all();
        $data = request()->except(['_token']);
        if (Auth::attempt($data)) {
            $user=Auth::user();
            if ($user->role=="admin") {
                return redirect()->route('admin-dashboard');
            }
            Auth::logout();

            return redirect()->route('admin.login')->with(['message'=>'Invalid login credentials ,Try again later', 'type'=>'info']);

        }else{
            return redirect()->route('admin.login')->with(['message'=>'Invalid login credentials ,Try again later', 'type'=>'info']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator =Validator::make($request->all(),[
            'username'=>'required',
            'email'=>'required|unique:users',
            'age'=>'required',
            'role'=>'required',
            'gender'=>'required',
            'phonenumber'=>'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with([
                'message'=>implode(' ', $validator->errors()->all()),
                 'type'=>'info'
             ]);
        }
        
        $user = new User;
        $user->username =$request->username;
        $user->email =$request->email;
        $user->phonenumber =$request->phonenumber;
        $user->age =$request->age;
        $user->role =$request->role;
        $user->password = Hash::make($request->email);

        if ($user->save()) {
             return redirect()->back()->with(['message'=>'User added successfully!', 'type'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Error occured, try again later', 'type'=>'info']);

    }

    /**
     * Admin will ban user if they wish to
     *
     * @param  \App\Admin\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function banUser(Request $request)
    {
        $validator =Validator::make($request->all(),[
            'user'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message'=>implode(' ', $validator->errors()->all()),
                 'type'=>'info'
             ]);
        }

        if (Auth::user()->id == $request->user) {
            Auth::logout();
        }
        $data=$request->all();

        $authId=Auth::user()->id;

        $exception = DB::transaction(function () use ($data,$authId) {
            try {

                $userID =$data['user'];

                $action ="";

                $message =$data['message'];


                if (User::where("id",$userID)->exists()) {


                    if($userID==$authId){
                        $action = "deactivated";

                        User::where("id",$userID)->update([
                            'status'=>'deactivated'
                        ]);

                    }else{
                        $action ="blocked";
                        BlockedUser::create([
                            'admin_id'=>$authId,
                            'suspect_id'=>$userID,
                            'reasons'=>$message
                        ]);
                        User::where("id",$userID)->update([
                            'status'=>'blocked'
                        ]);
                    }


                    $email =User::where("id",$userID)->first()->email;
                    $username =User::where("id",$data['user'])->first()->username;
                    # code...
                    Mail::to($email)->queue(new UserBanNotification($username,$message,$action));
                }


            } catch (Exception $e) {
            }
        });

        if (is_null($exception)) {
            return response()->json([
                'message' => 'User blocked!',
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'message' => 'Error occured , try again later!',
                'status' => 'info',
            ]);
        }
        return $request->all();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }

    public function logOut(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
