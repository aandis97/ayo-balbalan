<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tim;
use App\Models\Pemain;
use App\Models\TimPemain;
use App\Models\PosisiPemain;
use DB;

class TimPemainController extends Controller
{
    public function index()
    {
        
        $timPemain = TimPemain::rightJoin('tim','tim.id','tim_pemain.id_tim')
                ->select('tim.*',DB::raw('count(tim_pemain.id_tim) as jumlah_pemain'))
                ->groupBy('kamars.no_kamar','kamars.nama_kamar','kamars.kapasitas_kamar','kamars.id_kamar')
                ->get();
        return view('admin.tim-pemain.index');
    }
    
    
    public function getData(Request $request, $id)
    {

        // return 123;
        $dataPemain = TimPemain::join('pemain','tim_pemain.id_pemain','=','pemain.id')
        ->join('posisi_pemain','pemain.id_posisi','=','posisi_pemain.id')
        ->select("tim_pemain.*","pemain.nama","pemain.foto_pemain","pemain.tanggal_lahir","pemain.berat","pemain.tinggi",'posisi_pemain.nama_posisi')
        ->where('id_tim',$id)->where('status',1)->get();
        if($dataPemain) {
            return response()->json([
                'status'=>'oke',
                'data' => $dataPemain
                ]);
        } else {
            return response()->json(['status'=>'failed']);
        }
    }

    
    public function cariPemain(Request $request)
    { 
        
        $dataPemain = Pemain::join('posisi_pemain','pemain.id_posisi','=','posisi_pemain.id')
        ->select("pemain.*",'posisi_pemain.nama_posisi')->Where('bermain',"=",0);
        
        if(isset($request->nama)){
            $dataPemain->where('nama', 'LIKE', "%".$request->nama."%");
        }
        if(isset($request->kota)){
            $dataPemain->where('tempat_lahir', 'LIKE', "%".$request->kota."%");
        }
        if(isset($request->id_posisi)){
            $dataPemain->where('id_posisi',$request->id_posisi);
        }
        $dataPemain = $dataPemain->limit(15)->get(); 
        
        return response()->json([
            'status'=>'oke',
            'data' => $dataPemain
            ]); 

    }

    
    public function store(Request $request)
    {

            // return $request;
        if($request->ajax()){
            // if ($this->validateRequest($request)->fails()) {
            //     return response()->json([
            //         'status'=>'failed',
            //         'error' => $this->validateRequest($request)->messages()
            //         ]); 
            // }

            $insert =Tim::create([
                "nama_tim"=> $request->nama_tim,
                "alamat_tim"=> $request->alamat_tim,
                "id_kota"=> 1,
                "keterangan_tim"=> $request->keterangan_tim,
                "tahun_berdiri"=> $request->tahun_berdiri
            ]);

            if($request->hasFile('logo_tim')) {
                $uploadedFile = $request->file('logo_tim');
                $extension = '.'.$uploadedFile->getClientOriginalExtension();
                $filename  =$insert->id."_".date("dmy-His").$extension;
                $uploadedFile->move(base_path('public/images/tim/logo'), $filename);       
                
                $insert->update(['logo'=>$filename]);              
            }


            if($insert) {
                return response()->json(['status'=>'successful']);
            } else {
                return response()->json(['status'=>'failed']);
            }
        } else {
            return redirect('/');
        }
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()){
            // if ($this->validateRequest($request, $id)->fails()) {
            //     return response()->json([
            //         'status'=>'failed',
            //         'error' => $this->validateRequest($request, $id)->messages()
            //     ]);

            // }
            $tim =Tim::find($id);
            $filename = $tim->logo;

            if($request->hasFile('logo_tim')) {
                    
                $uploadedFile = $request->file('logo_tim');
                $extension = '.'.$uploadedFile->getClientOriginalExtension();
                $filename  =$id."_".date("dmy-His").$extension;
                $uploadedFile->move(base_path('public/images/tim/logo'), $filename);
                if($tim->logo){
                    unlink(base_path('public/images/tim/logo/'.$tim->logo)); 
                }
                    
            }
            
            $update = $tim->update([
                "nama_tim"=> $request->nama_tim,
                "alamat_tim"=> $request->alamat_tim,
                "id_kota"=> 1,
                "keterangan_tim"=> $request->keterangan_tim,
                "tahun_berdiri"=> $request->tahun_berdiri,
                "logo" => $filename
            ]);
 
            if($update) {
                return response()->json(['status'=>'successful']);
            } else {
                return response()->json(['status'=>'failed']);
            }
        } else {
            return redirect('/');
        }

    }

}
