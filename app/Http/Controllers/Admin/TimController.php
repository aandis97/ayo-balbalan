<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tim;
use App\Models\TimPemain;
use App\Models\PosisiPemain;
use Barryvdh\Debugbar\Facade as Debugbar;

class TimController extends Controller
{
    public function index()
    {
        return view('admin.tim.index');
    }
    public function getData()
    {
        // return 123;
         
        $dataTim = Tim::get();
        if($dataTim) {
            return response()->json([
                'status'=>'oke',
                'data' => $dataTim
                ]);
        } else {
            return response()->json(['status'=>'failed']);
        }
    }

    public function show($id)
    {
        return Tim::find($id)->pertandingans();
        // Debugbar::info(Tim::find($id)->pemains());
        return view('admin.index',[
            'tes'=>Tim::find($id)->pemains()
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
                "kota"=> $request->kota_tim,
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
                "kota"=> $request->kota_tim,
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

    public function edit($id)
    {
        $infoTim = Tim::find($id);
        $posisiPemain = PosisiPemain::get();
        return view('admin.tim.kelola-tim.index', compact('infoTim','posisiPemain')); 
    }

    public function deleteData(Request $request, $id)
    {
        if($request->ajax()){
            $query = Tim::find($id)->delete(); 

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
