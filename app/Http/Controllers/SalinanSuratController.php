<?php

namespace App\Http\Controllers;

use App\{SalinanSurat,LaporanVerlok,User};
use Illuminate\Http\Request;

class SalinanSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return salinanSurat::with('get_disposisi')->first();

        $list = salinanSurat::latest()->get();

        return view(session('level').'.salinan_surat.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(session('level').'.salinan_surat.create');
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
            'nomor' => 'required|unique:salinan_surats',
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

        salinanSurat::create([
            'tanggal_surat' => $request->tanggal_surat,
            'tujuan'    => $request->tujuan,
            'tanggal_diterima'  => $request->tanggal_diterima,
            'asal'  => $request->asal,
            'nomor' => $request->nomor,
            'perihal'   => $request->perihal,
            'nama_pt'   => $request->nama_pt,
            'lampiran'=> $lampiran,
            'status'    =>  "Salinan surat telah dikirim kepada ketua bidang"
        ]);
        $user = user::where([
            'level' =>  'kepala_bidang_kpp'
        ])->get();
        foreach ($user as $key) {
            $data = [
                'phone' => $key->no_hp, 
                'body' => 'Anda telah menerima salinan surat dari penerima surat pada tanggal '.date('d/m/Y').'. Harap segera melanjutkan proses', 
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
     * @param  \App\SalinanSurat  $salinanSurat
     * @return \Illuminate\Http\Response
     */
    public function show(SalinanSurat $salinanSurat)
    {
        return view(session('level').'.salinan_surat.detail',compact('salinanSurat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SalinanSurat  $salinanSurat
     * @return \Illuminate\Http\Response
     */
    public function edit(SalinanSurat $salinanSurat)
    {
        $data = $salinanSurat;
        return view(session('level').'.salinan_surat.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SalinanSurat  $salinanSurat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalinanSurat $salinanSurat)
    {
        if ($request->nomor!=$salinanSurat->nomor) {
            $this->validate($request, [
                'nomor' => 'required|unique:salinan_surats',
            ]);
        }

        $lampiran = $salinanSurat->lampiran;

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

        salinanSurat::find($salinanSurat->id)->update([
            'tanggal_surat' => $request->tanggal_surat,
            'tujuan'    => $request->tujuan,
            'tanggal_diterima'  => $request->tanggal_diterima,
            'asal'  => $request->asal,
            'nomor' => $request->nomor,
            'perihal'   => $request->perihal,
            'nama_pt'   => $request->nama_pt,
            'lampiran'=> $lampiran,
        ]);
        return back()->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SalinanSurat  $salinanSurat
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalinanSurat $salinanSurat)
    {
        if (file_exists(public_path('upload/lampiran/' . $salinanSurat->lampiran))) {
            unlink(public_path('upload/lampiran/' . $salinanSurat->lampiran));
        }
        
        foreach ($salinanSurat->get_verlok as $key) {
            $laporanverlok = laporanVerlok::where('id_permohonan_verlok',$key->id)->get();
            foreach ($laporanverlok as $e) {
                $e->get_rekomendasi()->delete();
                $e->delete();
            }
        }

        $salinanSurat->get_disposisi()->delete();
        $salinanSurat->get_verlok()->delete();
        $salinanSurat->get_rekomendasi()->delete();

        salinanSurat::destroy($salinanSurat->id);

        return back()->with('success','Data berhasil dihapus');
    }
}
