<?php

namespace App\Http\Controllers;

use App\governorate;
use App\Http\Requests\countriesRrquest;
use Illuminate\Http\Request;
use App\country;
class AdminCountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $countries=country::where('gov',0)->paginate(4);

        return view('admin.countries.index',compact('countries'));
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
        return view('admin.countries.create',compact('countries'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(countriesRrquest $request)
    {
        //
        $request->all();


        $country=new country();
        $country->country_name = $request->country_name;
        $country->country_code= $request->country_code ;
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

        $governorates=governorate::where('country_id' ,$id)->paginate(4);
        return view('admin.governorates.index',compact('governorates'));
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
        $countries=country::where('gov',0)->pluck('country_name', 'country_id')->all();

        $country=country::find($id);
        return view('admin.countries.edit',compact('country','countries'));
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


        $countries=country::find($id);

        $input = $request->all();

        $countries->update($input);

        return redirect('/admin/countries');
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
        country::find($id)->delete();
        return redirect()->back();
    }
}
