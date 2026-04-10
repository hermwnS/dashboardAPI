<?php

namespace App\Http\Controllers;

use App\Models\DataOrangModel;
use Illuminate\Http\Request;

class DataOrangContoller extends Controller
{
    public function index(){
        $data_orang = DataOrangModel::all();
        return view('manajemen_data', compact('data_orang'));
    }

    public function store(Request $request){
        $data_orang = new DataOrangModel();
        $data_orang->nama = $request->nama;
        $data_orang->alamat = $request->alamat;
        $data_orang->jenis_kelamin = $request->jenis_kelamin;
        $data_orang->usia = $request->usia;
        $data_orang->save();
        return redirect('manajemen_data')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id){
        $data_orang = DataOrangModel::find($id);
        return view('edit_data', compact('data_orang'));
    }

    public function update(Request $request, $id){
        $data_orang = DataOrangModel::find($id);
        $data_orang->nama = $request->nama;
        $data_orang->alamat = $request->alamat;
        $data_orang->jenis_kelamin = $request->jenis_kelamin;
        $data_orang->usia = $request->usia;
        $data_orang->update();

        return redirect('manajemen_data')->with('success', 'Data berhasil diperbarui!');
    }
    
    public function destroy($id){
        $data_orang = DataOrangModel::find($id);
        $data_orang->delete(); 

        return redirect('manajemen_data')->with('success', 'Data berhasil dihapus!');
    }
}
