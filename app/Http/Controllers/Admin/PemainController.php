<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemain;
use App\Models\Tim;
use App\Models\TimPemain;
use App\Models\PosisiPemain;
use DB;

class PemainController extends Controller
{
    public function index()
    {
        $dataTim = Tim::get();
        $posisiPemain = PosisiPemain::get();
        return view('admin.pemain.index', compact('posisiPemain','dataTim'));
    }

    public function cekNomorPunggung($tim, $nomor)
    {
        return $timPemain = TimPemain::where('id_tim',$tim)->where('nomor_punggung',$nomor)->where('status',1);
    }
    
    public function getData()
    {         
        // $dataPemain = Pemain::join('posisi_pemain','pemain.id_posisi','=','posisi_pemain.id')
        // ->select("pemain.*",'posisi_pemain.nama_posisi')->get();

        $subquery = DB::table('tim_pemain')->join('tim','tim.id','=','tim_pemain.id_tim')->select('tim_pemain.*','tim.nama_tim')->where('status','=',1);
        
        $dataPemain = Pemain::leftJoinSub($subquery, 'tim_pemain', 'tim_pemain.id_pemain', '=', 'pemain.id')
        ->join('posisi_pemain','pemain.id_posisi','=','posisi_pemain.id')
        ->select("pemain.*",'posisi_pemain.nama_posisi','tim_pemain.status','tim_pemain.nama_tim','tim_pemain.id_tim','tim_pemain.nomor_punggung')->orderBy('pemain.id','asc')->get();
        if($dataPemain) {
            return response()->json([
                'status'=>'oke',
                'data' => $dataPemain
                ]);
        } else {
            return response()->json(['status'=>'failed']);
        }
    }

    
    public function show($id)
    {
        dd(Pemain::find($id)->posisi->nama_posisi);
    }
    public function store(Request $request)
    {

            // return $request;
        if($request->ajax()){

            DB::beginTransaction();

            try
            {
                $insert =Pemain::create([
                    "nama"=> $request->nama,
                    "tempat_lahir"=> $request->tempat_lahir,
                    "tanggal_lahir"=> $request->tanggal_lahir,
                    "tinggi"=> $request->tinggi_badan,
                    "berat"=> $request->berat_badan,
                    "id_posisi" => $request->posisi_pemain
                ]);
    
                if($request->hasFile('foto_pemain')) {
                    $uploadedFile = $request->file('foto_pemain');
                    $extension = '.'.$uploadedFile->getClientOriginalExtension();
                    $filename  =$insert->id."_".date("dmy-His").$extension;
                    $uploadedFile->move(base_path('public/images/pemain'), $filename);       
                    $insert->update(['foto_pemain'=>$filename]);              
                }
    
                if(isset($request->tim_bermain)){
                    
                    if($this->cekNomorPunggung($request->tim_bermain, $request->nomor_punggung)->first()){  
                        DB::rollBack();                  
                        return response()->json([
                            'status'=>'failed',
                            'error_nomor_punggung' => "Nomor Punggung ".$request->nomor_punggung." Telah digunakan"
                            ]);
                    }
                    $insertTimPemain = TimPemain::create([
                        "id_tim" => $request->tim_bermain,
                        "id_pemain" => $insert->id,
                        "nomor_punggung" => $request->nomor_punggung,
                        "tanggal_gabung" => date("Y-m-d H:i:s"),
                        "status" => 1
                    ]); 
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

    
    public function update(Request $request, $id)
    {
        if($request->ajax()){             
            DB::beginTransaction();
            try
            {
                $pemain =Pemain::find($id);
                $filename = $pemain->foto_pemain;

                if($request->hasFile('foto_pemain')) {
                    $uploadedFile = $request->file('foto_pemain');
                    $extension = '.'.$uploadedFile->getClientOriginalExtension();
                    $filename  =$id."_".date("dmy-His").$extension;
                    $uploadedFile->move(base_path('public/images/pemain'), $filename);
                    if($pemain->foto_pemain){
                        unlink(base_path('public/images/pemain/'.$pemain->foto_pemain)); 
                    }
                }
                
                if(isset($request->tim_bermain) && $pemain->bermain==0 ){
                    if($this->cekNomorPunggung($request->tim_bermain, $request->nomor_punggung)->first()){  
                        DB::rollBack();                  
                        return response()->json([
                            'status'=>'failed',
                            'error_nomor_punggung' => "Nomor Punggung ".$request->nomor_punggung." Telah digunakan"
                            ]);
                    }
                    $insertTimPemain = TimPemain::create([
                        "id_tim" => $request->tim_bermain,
                        "id_pemain" => $id,
                        "nomor_punggung" => $request->nomor_punggung,
                        "tanggal_gabung" => date("Y-m-d H:i:s"),
                        "status" => 1
                    ]); 
                }

                if($pemain->bermain==1){
                    $timPemain = TimPemain::where('id_pemain',$id)->where('status',1)->orderBy("id",'desc')->first();
                
                    if( !(($timPemain->id_tim==$request->tim_bermain) and ($timPemain->nomor_punggung==$request->nomor_punggung)) ){
                        if($this->cekNomorPunggung($request->tim_bermain, $request->nomor_punggung)->first()){                
                            DB::rollBack();                  
                            return response()->json([
                                'status'=>'failed',
                                'error_nomor_punggung' => "Nomor Punggung ".$request->nomor_punggung." Telah digunakan"
                            ]);
                        }
                        $timPemain->update([
                            "id_tim" => $request->tim_bermain,
                            "nomor_punggung" => $request->nomor_punggung
                        ]);
                    }
                }
                
                $update = $pemain->update([
                    "nama"=> $request->nama,
                    "tempat_lahir"=> $request->tempat_lahir,
                    "tanggal_lahir"=> $request->tanggal_lahir,
                    "tinggi"=> $request->tinggi_badan,
                    "berat"=> $request->berat_badan,
                    "id_posisi" => $request->posisi_pemain,
                    "foto_pemain" => $filename,
                    "bermain" => 1
                ]);
                
                
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

    
    public function deleteData(Request $request, $id)
    {
        if($request->ajax()){
            $query = Pemain::find($id)->delete(); 

            if($query) {
                return response()->json(['status'=>'delete_successful']);
            } else {
                return response()->json(['status'=>'delete_failed']);
            }
        } else {
            return redirect('/');
        }
    }
     
 
}
