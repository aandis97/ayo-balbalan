<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tim;
use App\Models\TimPemain;
use App\Models\Pemain;
use App\Models\Pertandingan;
use App\Models\PertandinganDetail;
use Carbon\Carbon;
use DB;

class PertandinganController extends Controller
{
    public function index()
    {
        
        $dataTim = Tim::get();
        return view('admin.pertandingan.index', compact('dataTim'));
    }
    public function getData(Request $request)
    {
        // return 123;
        $date = Carbon::today();
        $data = Pertandingan::join('tim as tim_rumah','pertandingan.id_tim_rumah','=','tim_rumah.id')
        ->join('tim as tim_tamu','pertandingan.id_tim_tamu','=','tim_tamu.id')
        ->select('pertandingan.*','tim_rumah.nama_tim','tim_rumah.logo','tim_rumah.kota','tim_tamu.nama_tim as nama_tim_tamu','tim_tamu.logo as logo_tamu','tim_tamu.kota as kota_tamu');
        
        //     $data->where('pertandingan.jadwal_pertandingan','<=',Date('d-m-Y'))->whereNull('pertandingan.status');
        

        if($request->selesai) {
            $data->where('pertandingan.status',1);
        } else {
            
            $data->whereNull('pertandingan.status');
        }
        $data = $data->orderBy('pertandingan.jadwal_pertandingan','asc')
        ->orderBy('pertandingan.waktu_mulai','asc')->get();
        
        // return Date('d-m-Y');

        
        
        if($data) {
            return response()->json([
                'status'=>'oke',
                'data' => $data,
                'tanggal' => Date('d-m-Y')
                ]);
        } else {
            return response()->json(['status'=>'failed']);
        }
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
            $jadwal= date('Y-m-d', strtotime($request->jadwal_pertandingan));
            $insert =Pertandingan::create([
                "jadwal_pertandingan"=> $jadwal,
                "waktu_mulai"=> $request->waktu_mulai,
                "id_tim_rumah"=> $request->tim_rumah,
                "id_tim_tamu"=> $request->tim_tamu
            ]);

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
            $jadwal= date('Y-m-d', strtotime($request->jadwal_pertandingan));
            $update = Pertandingan::find($id)->update([
                "jadwal_pertandingan"=> $jadwal,
                "waktu_mulai"=> $request->waktu_mulai,
                "id_tim_rumah"=> $request->tim_rumah,
                "id_tim_tamu"=> $request->tim_tamu
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

    
    
    public function deleteData(Request $request, $id)
    {
        if($request->ajax()){
            $query = Pertandingan::find($id)->delete(); 

            if($query) {
                return response()->json(['status'=>'delete_successful']);
            } else {
                return response()->json(['status'=>'delete_failed']);
            }
        } else {
            return redirect('/');
        }
    }

    public function pertandinganSelesai()
    { 
        return view('admin.pertandingan.index-selesai');
    }

    public function pertandinganSelesaiDetail($id)
    { 
        $pertandingan = Pertandingan::find($id);
        
        // $subquery = DB::table('tim_pemain')->whereIn('id_tim',[$pertandingan->id_tim_rumah,$pertandingan->id_tim_tamu])->where('status',1);
        // ->leftJoinSub($subquery,'tim_pemain','pemain.id','tim_pemain.id_pemain')
        $pertandinganDetail = PertandinganDetail::withTrashed()->join('tim','detail_pertandingan.id_tim','tim.id')
        ->join('pemain','detail_pertandingan.id_pemain','pemain.id')
        ->select('detail_pertandingan.*','pemain.nama')
        ->where('id_pertandingan', $id)->orderBy('detail_pertandingan.menit',"asc")->get();
        // return $pertandinganDetail;
        if($pertandinganDetail) {
            return response()->json([
                'status'=>'oke',
                'data' => $pertandinganDetail
                ]);
        } else {
            return response()->json(['status'=>'failed']);
        }
    }

    public function getTim(Request $request)
    {
        
        $dataPemain = TimPemain::join('pemain','tim_pemain.id_pemain','=','pemain.id') 
        ->join('tim','tim_pemain.id_tim','=','tim.id') 
        ->select("tim_pemain.*","pemain.nama","pemain.foto_pemain","pemain.tanggal_lahir","pemain.berat","pemain.tinggi",'tim.nama_tim')
        ->whereIn('id_tim',[$request->tim_rumah,$request->tim_tamu])->where('status',1)->get();

        if($dataPemain) {
            return response()->json([
                'status'=>'oke',
                'data' => $dataPemain
                ]);
        } else {
            return response()->json(['status'=>'failed']);
        }
    }

    public function inputSkor(Request $request)
    {
        // return $request->all();
        if($request->ajax()){
            DB::beginTransaction();
            try
            {
                $pertandingan = Pertandingan::find($request->id_pertandingan_skor)->update([
                    "gol_rumah" => $request->skor_rumah,
                    "gol_tamu" => $request->skor_tamu,
                    "status" => 1
                ]);
                
                // id_pemain: ["3", "1", "3"]
                // id_tim: ["1", "2", "1"]
                // jenis_gol: ["1", "1", "2"]
                // menit: ["1", "3", "8"]
                if(isset($request->id_tim)) {
                    foreach($request->id_tim as $key => $id_tim) {
                        $id_pemain = $request->id_pemain[$key];
                        $jenis_gol = $request->jenis_gol[$key];
                        $menit = $request->menit[$key]; 
                        $detail = pertandinganDetail::create([
                            "id_pertandingan" => $request->id_pertandingan_skor,
                            "id_tim"=> $id_tim,
                            "id_pemain"=> $id_pemain,
                            "menit"=> $menit,
                            "jenis_gol"=> $jenis_gol
                        ]);
                    }
                }
                DB::commit(); 
                return response()->json(['status'=>'successful']);
            }
            catch (Exception $e)
            {
                DB::rollBack();
                return response()->json(['status'=>'failed']);
            } 
        } else {
            return redirect('/');
        }

    }
}
