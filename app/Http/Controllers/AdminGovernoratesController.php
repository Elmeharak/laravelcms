<?php

namespace App\Http\Controllers;

use App\country;
use App\governorate;
use Illuminate\Http\Request;

class AdminGovernoratesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $governorates=governorate::all();

        return view('admin.governorates.index',compact('governorates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $countries=country::where('gov',0)->pluck('country_name', 'country_id')->all();
        return view('admin.governorates.create',compact('countries'));    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'gov_name'=>'required|string|min:2'
        ]);


        $country=new governorate();
        $country->gov_name = $request->gov_name;
        $country->country_id= $request->country_id ;
        $country->save();
        return redirect('/admin/countries');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return"show";

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    }


    public function delete($id)
    {
        governorate::find($id)->delete();
        return redirect()->back();
    }
}

