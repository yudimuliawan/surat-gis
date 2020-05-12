<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = user::where('id','!=',session('id_user'))->latest()->get();
        return view('superadmin.user.index',compact('list'));
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

        $this->validate($request, [
            'username' => 'required|unique:users',
        ]);

        user::create([
            'username'  =>  $request->username,
            'no_hp'  =>  $request->no_hp,
            'name'  =>  $request->name,
            'level' =>  strtolower(str_replace(' ','_',$request->level)),
            'password'  =>  Hash::make($request->password)
        ]);
        return back()->with('success','Data berhasil ditambahkan');
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
        $user = user::find($id);
        if ($user->username!=$request->username) {
            $this->validate($request, [
                'username' => 'required|unique:users',
            ]);
        }

        $password = $user->password;
        if ($request->password!=null) {
            $password = Hash::make($request->password);
        }

        user::find($id)->update([
            'username'  =>  $request->username,
            'no_hp'  =>  $request->no_hp,
            'name'  =>  $request->name,
            'level' =>  strtolower(str_replace(' ','_',$request->level)),
            'password'  =>  $password
        ]);
        return back()->with('success','Data berhasil diupdate');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        user::destroy($id);

        return back()->with('success','Data berhasil dihapus');
    }
}
