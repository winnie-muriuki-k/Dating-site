<?php

namespace App\Http\Controllers;

use App\Cities;
use App\Countries;
use Illuminate\Http\Request;
use Validator;
class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = Cities::with('country')->get();

        $countries = Countries::all();

        return view('admin.cities' , compact('cities','countries'));
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
        $validator=Validator::make($request->all(), [
            'name' =>'required|unique:cities',
            'country' =>'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with([
                'message'=>implode(' ', $validator->errors()->all()),
                 'type'=>'info'
             ]);
        }
        $city =new Cities;
        $city->name =$request->name;
        $city->country_id =$request->country;
        if ($city->save()) {
             return redirect()->back()->with(['message'=>'City added successfully!', 'type'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Error occured, try again later', 'type'=>'info']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function EditCity(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'name' =>'required',
            'country' =>'required',
            'city_id'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'=>implode(' ', $validator->errors()->all()),
                'status' => 'info'
            ]);
        }

        $update =Cities::where('id',$request->city_id)->update([
            'country_id'=>$request->country,
            'name'=>$request->name
        ]);

        if ($update) {
            return response()->json([
                'message' => 'City successfully Updated!',
                'status' => 'success',
            ]);
        }else{
            return response()->json([
                'message' => 'Error occured please try again later',
                'status' => 'info'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function edit(Cities $cities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cities $cities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!empty($request->id)) {
            $id =$request->id;

            if (Cities::where("id",$id)->delete()) {
                return response()->json([
                    'message' => 'City successfully deleted!',
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
