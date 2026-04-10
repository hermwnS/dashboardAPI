<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\DataOrangModel;

class DashboardContoller extends Controller
{
    public function index(){
        
        return view('dashboard');
    }

    public function getDashboardData(){
        $totalData = DataOrangModel::count();
        $genderData = DataOrangModel::selectRaw('jenis_kelamin, COUNT(*) as count')
                                    ->groupBy('jenis_kelamin')
                                    ->get()
                                    ->pluck('count', 'jenis_kelamin');
        
        // Group age into categories
        $ageCategories = [
            '0-20' => DataOrangModel::whereBetween('usia', [0, 20])->count(),
            '21-40' => DataOrangModel::whereBetween('usia', [21, 40])->count(),
            '41-60' => DataOrangModel::whereBetween('usia', [41, 60])->count(),
            '61+' => DataOrangModel::where('usia', '>', 60)->count(),
        ];
        
        return response()->json([
            'total' => $totalData,
            'gender' => $genderData,
            'age' => $ageCategories
        ]);
    }
}
