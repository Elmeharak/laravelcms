<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\User;
class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $users=User::all();
        return view('admin.users.index' ,compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles=Role::pluck('role_name','role_id')->all();
        return view('admin.users.create' ,compact('roles'));
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
           'name' => 'required',
            'email' => 'required',
            'pass' => 'required',
            'role_id' => 'required',

        ]);

        $input['user_name']=$request->name;
        $input['user_email']=$request->email;
        $input['password']=$request->pass;
        $input['role_id']=$request->role_id;
        $user=User::create($input);
        return redirect('/admin/users');

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
        return view('admin.users.show');

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
        return view('admin.users.edit');

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
    public function deleteUser(Request $request){
        if( $request->user_id && is_numeric($request->user_id)){

            $user = User::find($request->user_id);
            if($user){

                $user->delete();
                return json_encode(["status" => 1, "message" => "<div class='alert alert-success'>User removed successfully</div>"]);
            }
        }
        return json_encode(["status" => 0, "message" => "<div class='alert alert-danger'>Error !</div>"]);

    }
}
