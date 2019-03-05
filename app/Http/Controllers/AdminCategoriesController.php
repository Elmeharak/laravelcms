<?php

namespace App\Http\Controllers;

use App\category;
use App\Http\Requests\categoriesRequest;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories=category::where('cat_sub' ,0)->paginate(4);
         return view('admin.categories.index',compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $categories=category::where('cat_sub',0)->pluck('cat_name', 'cat_id')->all();
        return view('admin.categories.create',compact('categories'));
//        return view('admin.categories.create');
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
        $request->validate([
            'cat_name' => 'required|string|min:2|max:100'

        ]);



        $category=new category();
        $category->cat_name = $request->cat_name;
        $category->cat_sub  =  $request->cat_sub;
        $category->save();
        return redirect('/admin/categories');

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
          $categories=category::where('cat_sub' ,$id)->paginate(4);
         return view('admin.categories.index',compact('categories'));
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


        $categories=category::where('cat_sub',0)->pluck('cat_name', 'cat_id')->all();

        $category=category::find($id);

         return view('admin.categories.edit',compact('category','categories'));

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

            $category=category::find($id);
            $category->cat_sub  =  $request->cat_sub;

            $input = $request->all();

            $category->update($input);

            return redirect('/admin/categories');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        category::find($id)->delete();
        return redirect()->back();

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        category::find($id)->delete();
        return redirect()->back();
    }

    public function deleteCat(Request $request){
        if( $request->cat_id && is_numeric($request->cat_id)){

            $cat = category::find($request->cat_id);
            if($cat){
                $cat->delete();
                return json_encode(["status" => 1, "message" => "<div class='alert alert-success'>Categories removed successfully</div>"]);
            }
        }
        return json_encode(["status" => 0, "message" => "<div class='alert alert-danger'>Error !</div>"]);

    }
}
