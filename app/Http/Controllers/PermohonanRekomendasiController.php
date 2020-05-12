<?php

namespace App\Http\Controllers;

use App\PermohonanRekomendasi;
use Illuminate\Http\Request;

class PermohonanRekomendasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = PermohonanRekomendasi::latest()->get();

        return view('penerima_surat_kpp.permohonan_rekomendasi.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penerima_surat_kpp.permohonan_rekomendasi.create');
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
            'nomor' => 'required|unique:permohonan_rekomendasis',
        ]);


        $lampiran ="";
        if ($request->hasFile('lampiran')) {
            $image = $request->file('lampiran');

            $nama_file = time() . "." . $image->getClientOriginalName();

            $tujuan_upload = public_path('upload/lampiran/');

            if ($image->move($tujuan_upload, $nama_file)) {
                if ($lampiran!="") {
                    if (file_exists(public_path('upload/lampiran/' . $lampiran))) {
                        unlink(public_path('upload/lampiran/' . $lampiran));
                    }
                }
                $lampiran = $nama_file;
            } else {
                return back()->with('error', 'Lampiran gagal di upload');
            }
        }

        permohonanRekomendasi::create([
            'tujuan'=> $request->tujuan,
            'asal'=> $request->asal,
            'nomor'=> $request->nomor,
            'perihal'=> $request->perihal,
            'nama_pt'=> $request->nama_pt,
            'pj'=> $request->pj,
            'lokasi'=> $request->lokasi,
            'lampiran'=> $lampiran,
        ]);
        return back()->with('success','Data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PermohonanRekomendasi  $permohonanRekomendasi
     * @return \Illuminate\Http\Response
     */
    public function show(PermohonanRekomendasi $permohonanRekomendasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PermohonanRekomendasi  $permohonanRekomendasi
     * @return \Illuminate\Http\Response
     */
    public function edit(PermohonanRekomendasi $permohonanRekomendasi)
    {
        $data = $permohonanRekomendasi;
        return view('penerima_surat_kpp.permohonan_rekomendasi.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PermohonanRekomendasi  $permohonanRekomendasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PermohonanRekomendasi $permohonanRekomendasi)
    {
        if ($request->nomor!=$permohonanRekomendasi->nomor) {
            $this->validate($request, [
                'nomor' => 'required|unique:permohonan_rekomendasis',
            ]);
        }

        $lampiran = $permohonanRekomendasi->lampiran;

        if ($request->hasFile('lampiran')) {
            $image = $request->file('lampiran');

            $nama_file = time() . "." . $image->getClientOriginalName();

            $tujuan_upload = public_path('upload/lampiran/');

            if ($image->move($tujuan_upload, $nama_file)) {
                if ($lampiran!="") {
                    if (file_exists(public_path('upload/lampiran/' . $lampiran))) {
                        unlink(public_path('upload/lampiran/' . $lampiran));
                    }
                }
                $lampiran = $nama_file;
            } else {
                return back()->with('error', 'Lampiran gagal di upload');
            }
        }

        permohonanRekomendasi::find($permohonanRekomendasi->id)->update([
            'tujuan'=> $request->tujuan,
            'asal'=> $request->asal,
            'nomor'=> $request->nomor,
            'perihal'=> $request->perihal,
            'nama_pt'=> $request->nama_pt,
            'pj'=> $request->pj,
            'lokasi'=> $request->lokasi,
            'lampiran'=> $lampiran,
        ]);

        return back()->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PermohonanRekomendasi  $permohonanRekomendasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(PermohonanRekomendasi $permohonanRekomendasi)
    {

        if (file_exists(public_path('upload/lampiran/' . $permohonanRekomendasi->lampiran))) {
            unlink(public_path('upload/lampiran/' . $permohonanRekomendasi->lampiran));
        }
        permohonanRekomendasi::destroy($permohonanRekomendasi->id);

        return back()->with('success','Data berhasil dihapus');
    }
}
