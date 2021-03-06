<?php

namespace App\Http\Controllers\Admin;

use App\Countries;
use App\Cities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

use DB;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $countries = Countries::all();

        return view('admin.countries' , compact('countries'));
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
            'name' =>'required|unique:countries'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with([
                'message'=>implode(' ', $validator->errors()->all()),
                 'type'=>'info'
             ]);
        }
        $country =new Countries;
        $country->name =$request->name;
        if ($country->save()) {
             return redirect()->back()->with(['message'=>'Country added successfully!', 'type'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Error occured, try again later', 'type'=>'info']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!empty($request->id)) {
            $id =$request->id;
            $exception = DB::transaction(function () use ($id) {
                try {
                        Countries::where("id",$id)->delete();
                        Cities::where("country_id",$id)->delete();
                } catch (Exception $e) {
                }
            });

            if (is_null($exception)) {
                return response()->json([
                    'message' => 'Country successfully deleted!',
                    'status' => 'success',
                ]);
            } else {
                return response()->json([
                    'message' => 'Error occured please try again later',
                    'status' => 'info',
                    'data'=>$exception
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
