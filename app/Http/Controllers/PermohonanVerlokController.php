<?php

namespace App\Http\Controllers;

use App\{PermohonanVerlok,SalinanSurat,User,LaporanVerlok,Rekomendasi};
use Illuminate\Http\Request;

class PermohonanVerlokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = PermohonanVerlok::latest()->get();

        return view(session('level').'.permohonan_verlok.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $surat = salinanSurat::latest()->get();
        $number = permohonanVerlok::latest()->first();
        if (!empty($number)) {
            $number = $number->id + 1;
        }else{
            $number = 1;
        }
        $kode = '545/'.str_pad($number, 4,0,STR_PAD_LEFT).'/120.04/'.date('Y');
        return view(session('level').'.permohonan_verlok.create',compact('surat','kode'));
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
            'nomor' => 'required|unique:permohonan_verloks',
        ]);

        permohonanVerlok::create($request->all());
        salinanSurat::find($request->id_surat)->update([
            'status'    => "Staff memberi permohonan verifikasi lokasi pada ".$request->tujuan
        ]);

        $user = user::where([
            'level' =>  'pegawai_cabang_dinas'
        ])->get();
        foreach ($user as $key) {
            $data = [
                'phone' => $key->no_hp, 
                'body' => 'Anda telah menerima permohonan verifikasi lokasi dari DKP Provinsi Jawa Timur pada tanggal '.date('d/m/Y').'. Harap segera menyelesaikan proses', 
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
     * @param  \App\PermohonanVerlok  $permohonanVerlok
     * @return \Illuminate\Http\Response
     */
    public function show(PermohonanVerlok $permohonanVerlok)
    {
        return view(session('level').'.permohonan_verlok.detail',compact('permohonanVerlok'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PermohonanVerlok  $permohonanVerlok
     * @return \Illuminate\Http\Response
     */
    public function edit(PermohonanVerlok $permohonanVerlok)
    {
        $surat = salinanSurat::latest()->get();
        $data = $permohonanVerlok;
        return view(session('level').'.permohonan_verlok.edit',compact('surat','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PermohonanVerlok  $permohonanVerlok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PermohonanVerlok $permohonanVerlok)
    {
        if ($request->nomor!=$permohonanVerlok->nomor) {
            $this->validate($request, [
                'nomor' => 'required|unique:permohonan_verloks',
            ]);
        }

        $permohonanVerlok->update($request->all());

        return back()->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PermohonanVerlok  $permohonanVerlok
     * @return \Illuminate\Http\Response
     */
    public function destroy(PermohonanVerlok $permohonanVerlok)
    {
        $permohonan = $permohonanVerlok->get_laporan()->get();
        foreach ($permohonan as $key) {
            $laporan_verlok = LaporanVerlok::find($key->id);
            // foreach ($laporan_verlok as $l) {
                Rekomendasi::where('id_laporan_verlok',$key->id)->delete();
            // }
            LaporanVerlok::destroy($key->id);
        }
        $permohonanVerlok->delete();

        return back()->with('success','Data berhasil dihapus');
    }

    public function lokasi($id)
    {
        $data = PermohonanVerlok::find($id);
        return view('superadmin.permohonan_verlok.lokasi',compact('data'));
    }
}
