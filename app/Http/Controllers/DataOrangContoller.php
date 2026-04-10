<?php

namespace App\Http\Controllers;

use App\Models\DataOrangModel;
use Illuminate\Http\Request;

class DataOrangContoller extends Controller
{
    /**
     * Function untuk melakukan pencarian data
     * @param string $keyword - kata kunci pencarian
     * @return Collection data yang sesuai dengan pencarian
     */
    public function search($keyword)
    {
        return DataOrangModel::where('nama', 'like', '%' . $keyword . '%')
                             ->orWhere('alamat', 'like', '%' . $keyword . '%')
                             ->orWhere('jenis_kelamin', 'like', '%' . $keyword . '%')
                             ->get();
    }

    /**
     * Function untuk AJAX search - digunakan oleh live search
     * @param Request $request
     * @return JSON
     */
    public function searchAjax(Request $request)
    {
        $keyword = $request->get('q', '');
        $results = $keyword ? $this->search($keyword) : [];
        return response()->json($results);
    }

    public function index(Request $request){
        $search = $request->get('search');
        $data_orang = $search ? $this->search($search) : DataOrangModel::all();
        return view('manajemen_data', compact('data_orang', 'search'));
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
