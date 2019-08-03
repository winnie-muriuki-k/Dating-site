<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles =Role::all();
        return view('admin.roles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator=Validator::make($request->all(), [
            'name' =>'required|unique:roles'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with([
                'message'=>implode(' ', $validator->errors()->all()),
                 'type'=>'info'
             ]);
        }
        $role =new Role;
        $role->name =$request->name;
        if ($role->save()) {
             return redirect()->back()->with(['message'=>'Role added successfully!', 'type'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Error occured, try again later', 'type'=>'info']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!empty($request->id)) {
            $id =$request->id;

            if (Role::where("id",$id)->delete()) {
                return response()->json([
                    'message' => 'Role successfully deleted!',
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
}
