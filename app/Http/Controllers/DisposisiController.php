<?php

namespace App\Http\Controllers;

use App\{Disposisi,SalinanSurat,User};
use Illuminate\Http\Request;

class DisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Disposisi::with('get_surat')->latest()->get();

        return view(session('level').'.disposisi.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $surat = salinanSurat::latest()->get();
        return view(session('level').'.disposisi.create',compact('surat'));
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
            'nomor' => 'required|unique:disposisis',
        ]);

        disposisi::create($request->all());
        salinanSurat::find($request->id_surat)->update([
            'status'    =>  "Ketua bidang memberikan disposisi kepada ".$request->tujuan
        ]);
        if (strtolower($request->tujuan)=="kepala seksi prl") {
            $user = user::where([
                'level' =>  "kepala_seksi_prl"
            ])->get();
        }else{
            $user = user::where([
                'level' =>  "penerima_surat_kpp"
            ])->get();
        }
        foreach ($user as $key) {
            $msg = 'Anda telah mendapatkan disposisi dari kepala bidang pada tanggal '.date('d/m/Y').'. Harap segera melanjutkan proses.';
            if (strtolower($request->tujuan)=="penerima surat") {
                $msg = 'Anda telah menerima disposisi dari kepala bidang pada tanggal '.date('d/m/Y').'. Harap segera menyelesaikan proses';
            }
            $data = [
                'phone' => $key->no_hp, 
                'body' => $msg, 
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
     * @param  \App\Disposisi  $disposisi
     * @return \Illuminate\Http\Response
     */
    public function show(Disposisi $disposisi)
    {
        return view(session('level').'.disposisi.detail',compact('disposisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disposisi  $disposisi
     * @return \Illuminate\Http\Response
     */
    public function edit(Disposisi $disposisi)
    {
        $data = $disposisi;
        $surat = salinanSurat::latest()->get();

        return view(session('level').'.disposisi.edit',compact('data','surat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disposisi  $disposisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disposisi $disposisi)
    {
        if ($request->nomor != $disposisi->nomor) {
            $this->validate($request, [
                'nomor' => 'required|unique:disposisis',
            ]);
        }

        $disposisi->update($request->all());
        return back()->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disposisi  $disposisi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disposisi $disposisi)
    {
        $disposisi->delete();

        return back()->with('success','Data berhasil dihapus');
    }
}
