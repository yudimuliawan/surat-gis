<?php

namespace App\Http\Controllers;

use App\{Rekomendasi,LaporanVerlok,SalinanSurat,Wilayah};
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Rekomendasi::latest()->get();
        if (session('level')=="kepala_bidang_kpp") {
            $list = Rekomendasi::where('is_approve',1)->latest()->get();
        }
        return view(session('level').'.rekomendasi.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $surat = SalinanSurat::latest()->get();
        $laporan_verlok = LaporanVerlok::latest()->get();
        $number = Rekomendasi::latest()->first();
        if (!empty($number)) {
            $number = $number->id + 1;
        }else{
            $number = 1;
        }
        $kode = '545/'.str_pad($number, 4,0,STR_PAD_LEFT).'/120.04/'.date('Y');

        return view(session('level').'.rekomendasi.create',compact('surat','laporan_verlok','kode'));
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
            'nomor' => 'required|unique:rekomendasis',
        ]);

        rekomendasi::create($request->all());
        salinanSurat::find($request->id_surat)->update([
            'status'    =>  "Surat rekomendasi telah diterbitkan"
        ]);
        return back()->with('success','Data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rekomendasi  $rekomendasi
     * @return \Illuminate\Http\Response
     */
    public function show(Rekomendasi $rekomendasi)
    {
        return view(session('level').'.rekomendasi.detail',compact('rekomendasi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rekomendasi  $rekomendasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Rekomendasi $rekomendasi)
    {
        $surat = salinanSurat::latest()->get();
        $laporan_verlok = LaporanVerlok::latest()->get();
        $data = $rekomendasi;
        return view(session('level').'.rekomendasi.edit',compact('surat','data','laporan_verlok'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rekomendasi  $rekomendasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rekomendasi $rekomendasi)
    {

        if ($rekomendasi->nomor!=$request->nomor) {

            $this->validate($request, [
                'nomor' => 'required|unique:rekomendasis',
            ]);
        }

        $rekomendasi->update($request->all());
        return back()->with('success','Data berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rekomendasi  $rekomendasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rekomendasi $rekomendasi)
    {
        $rekomendasi->delete();

        return back()->with('success','Data berhasil dihapus');
    }

    public function koordinat()
    {
        $list = rekomendasi::latest()->get();
        $wilayah = wilayah::latest()->get();
        return view(session('level').'.rekomendasi.koordinat',compact('list','wilayah'));
    }

    public function approve($id)
    {
        Rekomendasi::find($id)->update([
            'is_approve'    =>  1
        ]);
        return back()->with('success','Surat berhasil diverifikasi');
    }
}
