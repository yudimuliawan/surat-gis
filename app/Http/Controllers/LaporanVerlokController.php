<?php

namespace App\Http\Controllers;

use App\{LaporanVerlok,PermohonanVerlok,SalinanSurat,User};
use Illuminate\Http\Request;

class LaporanVerlokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = LaporanVerlok::latest()->get();
        return view(session('level').'.laporan_verlok.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $number = laporanVerlok::latest()->first();
        if (!empty($number)) {
            $number = $number->id + 1;
        }else{
            $number = 1;
        }
        $kode = '545/'.str_pad($number, 4,0,STR_PAD_LEFT).'/120.61/'.date('Y');
        $permohonan = permohonanVerlok::latest()->get();
        return view(session('level').'.laporan_verlok.create',compact('permohonan','kode'));
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
            'nomor' => 'required|unique:laporan_verloks',
        ]);


        $foto_kegiatan ="";
        if ($request->hasFile('foto_kegiatan')) {
            $image = $request->file('foto_kegiatan');

            $nama_file = time() . "." . $image->getClientOriginalName();

            $tujuan_upload = public_path('upload/laporan_verlok/');

            if ($image->move($tujuan_upload, $nama_file)) {
                if ($foto_kegiatan!="") {
                    if (file_exists(public_path('upload/laporan_verlok/' . $foto_kegiatan))) {
                        unlink(public_path('upload/laporan_verlok/' . $foto_kegiatan));
                    }
                }
                $foto_kegiatan = $nama_file;
            } else {
                return back()->with('error', 'Lampiran gagal di upload');
            }
        }

        laporanVerlok::create([
            'id_permohonan_verlok'=>$request->id_surat,
            'nomor'=>$request->nomor,
            'perihal'=>$request->perihal,
            'tujuan'=>$request->tujuan,
            'tanggal_survey'=>$request->tanggal_survey,
            'waktu_survey'=>$request->waktu_survey,
            'lng'=>$request->lng,
            'lat'=>$request->lat,
            'hasil_verifikasi'=>$request->hasil_verifikasi,
            'foto_kegiatan'=>$foto_kegiatan,
            'saran'=>$request->saran,
        ]);

        $permohonan_verlok = permohonanVerlok::find($request->id_surat);
        salinanSurat::find($permohonan_verlok->id_surat)->update([
            'status'    =>  "Cabang dinas telah mengirimkan laporan verifikasi lokasi"
        ]);


        $user = user::where([
            'level' =>  'staff_seksi_prl'
        ])->get();
        foreach ($user as $key) {
            $data = [
                'phone' => $key->no_hp, 
                'body' => 'Anda telah mendapat laporan verifikasi lokasi dari cabang dinas pada tanggal '.date('d/m/Y').'. Harap segera menyelesaikan proses', 
            ];
            $json = json_encode($data); 

            $url = 'https://eu112.chat-api.com/instance117791/sendMessage?token='.env('CHAT_API_TOKEN');

            $options = stream_context_create(['http' => ['method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $json ]
            ]);

            $result = file_get_contents($url, false, $options);
        }

        return back()->with('success','Data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LaporanVerlok  $laporanVerlok
     * @return \Illuminate\Http\Response
     */
    public function show(LaporanVerlok $laporanVerlok)
    {
        return view(session('level').'.laporan_verlok.detail',compact('laporanVerlok'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LaporanVerlok  $laporanVerlok
     * @return \Illuminate\Http\Response
     */
    public function edit(LaporanVerlok $laporanVerlok)
    {
        $permohonan = permohonanVerlok::latest()->get();
        $data = $laporanVerlok;
        return view(session('level').'.laporan_verlok.edit',compact('permohonan','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LaporanVerlok  $laporanVerlok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaporanVerlok $laporanVerlok)
    {
        if ($request->nomor!=$laporanVerlok->nomor) {

            $this->validate($request, [
                'nomor' => 'required|unique:laporan_verloks',
            ]);
        }


        $foto_kegiatan = $laporanVerlok->foto_kegiatan;
        if ($request->hasFile('foto_kegiatan')) {
            $image = $request->file('foto_kegiatan');

            $nama_file = time() . "." . $image->getClientOriginalName();

            $tujuan_upload = public_path('upload/laporan_verlok/');

            if ($image->move($tujuan_upload, $nama_file)) {
                if ($foto_kegiatan!="") {
                    if (file_exists(public_path('upload/laporan_verlok/' . $foto_kegiatan))) {
                        unlink(public_path('upload/laporan_verlok/' . $foto_kegiatan));
                    }
                }
                $foto_kegiatan = $nama_file;
            } else {
                return back()->with('error', 'Lampiran gagal di upload');
            }
        }

        $laporanVerlok->update([
            'id_permohonan_verlok'=>$request->id_surat,
            'nomor'=>$request->nomor,
            'perihal'=>$request->perihal,
            'tujuan'=>$request->tujuan,
            'tanggal_survey'=>$request->tanggal_survey,
            'waktu_survey'=>$request->waktu_survey,
            'lng'=>$request->lng,
            'lat'=>$request->lat,
            'hasil_verifikasi'=>$request->hasil_verifikasi,
            'foto_kegiatan'=>$foto_kegiatan,
            'saran'=>$request->saran,
        ]);

        return back()->with('success','Data berhasil ditambahkan');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LaporanVerlok  $laporanVerlok
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaporanVerlok $laporanVerlok)
    {
        if (file_exists(public_path('upload/laporan_verlok/' . $laporanVerlok->foto_kegiatan))) {
            unlink(public_path('upload/laporan_verlok/' . $laporanVerlok->foto_kegiatan));
        }
        $laporanVerlok->get_rekomendasi()->delete();
        laporanVerlok::destroy($laporanVerlok->id);

        return back()->with('success','Data berhasil dihapus');
    }

    public function lokasi($id)
    {
        $data = LaporanVerlok::find($id);
        return view('superadmin.laporan_verlok.lokasi',compact('data'));
    }
}
