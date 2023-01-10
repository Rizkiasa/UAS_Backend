<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PerangkatResource;
use App\Models\Perangkat;
use Illuminate\Support\Facades\Validator;

class PerangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_perangkat = Perangkat::all();

        return new PerangkatResource(true,'Data Perangkat Desa !' , $data_perangkat);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jabatan' => 'required',
            'nama' => 'required',
            'ttl' => 'required',
            'pendidikan' => 'required',
            'mulai_menjabat' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }else{
            $data_perangkat = Perangkat::create([
                'jabatan' => $request->jabatan,
                'nama' => $request->nama,
                'ttl' => $request->ttl,
                'pendidikan' => $request->pendidikan,
                'mulai_menjabat' => $request->mulai_menjabat,
            ]);

            return new PerangkatResource(true, 'Data berhasil tersimpan !', $data_perangkat);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data_perangkat = Perangkat::find($id);

        if($data_perangkat){
            return new PerangkatResource(true, 'Data ditemukan !', $data_perangkat);
        } else {
            return response()->json([
                'message' => 'Data tidak ditemukan !'
            ], 422);
        }
        }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jabatan' => 'required',
            'nama' => 'required',
            'ttl' => 'required',
            'pendidikan' => 'required',
            'mulai_menjabat' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }else{
            $data_perangkat = Perangkat::find($id);

            if($data_perangkat){
                $data_perangkat->jabatan = $request->jabatan;
                $data_perangkat->nama = $request->nama;
                $data_perangkat->ttl = $request->ttl;
                $data_perangkat->pendidikan = $request->pendidikan;
                $data_perangkat->mulai_menjabat = $request->mulai_menjabat;
                $data_perangkat->save();

                return new PerangkatResource(true, 'Data berhasil di update !', $data_perangkat);
            }else{
                return response()->json([
                    'message' => 'Data tidak ditemukan !'
                ]);
            }
            }
        }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data_perangkat = Perangkat::find($id);

        if($data_perangkat){
            $data_perangkat->delete();

            return new PerangkatResource(true, 'Data berhasil di hapus !', '');
        }else{
            return response()->json([
                'message' => 'Data tidak ditemukan !'
            ]);
        }
    }
}
