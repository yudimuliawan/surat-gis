<?php

namespace App\Http\Controllers;

use App\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = wilayah::latest()->get();
        return view('superadmin.wilayah.index',compact(('list')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("superadmin.wilayah.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $lnglat = [];
        $no = 0;
        foreach ($request->lng as $key) {
            $new = [$key,$request->input('lat')[$no]];
            array_push($lnglat, $new);
            $no++;
        }

        wilayah::create([
            'nama'   =>  $request->nama,
            'warna'   =>  $request->warna,
            'lnglat'   =>  json_encode($lnglat),
        ]);
        return back()->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wilayah  $wilayah
     * @return \Illuminate\Http\Response
     */
    public function show(Wilayah $wilayah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wilayah  $wilayah
     * @return \Illuminate\Http\Response
     */
    public function edit(Wilayah $wilayah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wilayah  $wilayah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wilayah $wilayah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wilayah  $wilayah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wilayah $wilayah)
    {
        $wilayah->delete();

        return back()->with('success','Data berhasil dihapus');
    }

    public function map($wilayah)
    {
        $wilayah = wilayah::find($wilayah);
        return view('penerima_surat_kpp.wilayah.map',compact('wilayah'));
    }
}
