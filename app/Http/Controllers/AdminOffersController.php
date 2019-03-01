<?php

namespace App\Http\Controllers;

use App\country;
use App\governorate;
use App\offer;
use App\offerImage;
use Faker\Provider\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $offers=offer::orderBy('offer_id', 'desc')->paginate(5);

        return view('admin.offers.index',compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $countries = country::where('gov', 0)->pluck('country_name', 'country_id')->all();

        return view('admin.offers.create', compact('countries'));
    }

    public function GetSubCountry($id)
    {
        $gov = governorate::where('country_id',$id)->pluck('gov_name', 'gov_id');

        return json_encode($gov);
    }

    public function store(Request $request)
    {
        // $now = date('YmdHis');

        //Simple Validation
        $request->validate([
            'title' => 'bail|required|min:3',
            'description' => 'required',
            'country_id' => 'required',
            'gov_id' => 'required',
            'image' => 'required',
            'price' => 'required|integer',
        ]);

        $user = Auth::user();

        $arr['title'] = $request->title;
        $arr['price'] = $request->price;
        $arr['description'] = $request->description;
        $arr['country_id'] = $request->country_id;
        $arr['gov_id'] = $request->gov_id;
        $arr['user_id'] = $user->user_id;

        if ($file = $request->file('image')) {
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/offers'), $name);
            $arr['image'] = $name;
        }

        $offer = offer::create($arr);


        if($file = $request->file('images')){
            $img_arr = [];
            $img_arr['offer_id'] =$offer->offer_id;
            foreach ($file as $k => $image){
                $name = time() .'-'. $k . '.' .$image->getClientOriginalExtension();
                $image->move(public_path('images'), $name);
                $img_arr['image'] = $name;
                offerImage::create($img_arr);
            }
        }

        return redirect('/admin/offers');
    }


        //delete offer image in edit
    public function deleteOfferImage(Request $request)
    {
        if($id = $request->id){
            $offer = offer::find($id);
            if( $offer ){
                $file = public_path("images/{$offer->image}");
                if( File::exists($file) ){
                    File::delete($file);
                }
//                $offer->delete();
                return 1;
            }
        }
        return 0;

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //


        return $id ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $offer = offer::find($id);

        $countries = country::where('gov', 0)->pluck('country_name', 'country_id')->all();

        $govs = governorate::where('country_id', $offer->country_id)->pluck('gov_name', 'gov_id')->all();

        $images=offerImage::where('offer_id',$offer->offer_id)->pluck('image', 'id')->all();

        return view('admin.offers.edit',compact('offer','countries', 'govs' ,'images'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Simple Validation
        $request->validate([
            'title' => 'bail|required|min:3',
            'description' => 'required',
            'country_id' => 'required',
            'gov_id' => 'required',
//            'image' => 'required',
            'price' => 'required|integer',
        ]);

        $offer = offer::find($id);

        $input = $request->all();

        if ($file = $request->file('image')) {
            $name = time() . '.' .$file->getClientOriginalName();
            $file->move(public_path('images/offers'), $name);
            $input['image'] = $name;
        }

        $offer->update($input);

        if($file = $request->file('images')){
            $img_arr = [];
            $img_arr['offer_id'] =$offer->offer_id;
            foreach ($file as $k => $image){
                $name = time() .$k . '.' .$image->getClientOriginalExtension();
                $image->move(public_path('images'), $name);
                $img_arr['image'] = $name;
                offerImage::create($img_arr);
            }
        }


        Session::flash('update_offer', 'the offer has been updated');

        return redirect('/admin/offers');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if($id ){
            $offer= offer::find($id);
            $offer_img = offerImage::where('offer_id',$offer->offer_id);

            if( $offer_img){
//                $file = public_path("images/{$offer_img->image}");
//                if( File::exists($file) ){
//                    File::delete($file);
//                }
                $offer_img->delete();
            }
            $offer->delete();

            Session::flash('delete_offer', 'the offer has been deleted');
        }

        return redirect('/admin/offers');
    }

    public function deleteGallery(Request $request){
        if( $request->image_id && is_numeric($request->image_id)){
            $img = offerImage::find($request->image_id);
            if( $img ){
                $img->delete();
                //return "<div class='alert alert-success'>Image removed successfully</div>";
                return json_encode(["status" => 1, "message" => "<div class='alert alert-success'>Image removed successfully</div>"]);
            }
        }
        return json_encode(["status" => 0, "message" => "<div class='alert alert-danger'>Error !</div>"]);
        //return "<div class='alert alert-danger'>Error !</div>";
    }



}
