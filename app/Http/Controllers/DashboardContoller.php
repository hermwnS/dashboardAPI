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

    public function getDashboardData(Request $request){
        $from = $request->query('from');
        $to = $request->query('to');

        $query = DataOrangModel::query();

        if ($from) {
            $query->whereDate('created_at', '>=', $from);
        }

        if ($to) {
            $query->whereDate('created_at', '<=', $to);
        }

        $totalData = (clone $query)->count();

        $genderData = (clone $query)
            ->selectRaw('jenis_kelamin, COUNT(*) as count')
            ->groupBy('jenis_kelamin')
            ->get()
            ->pluck('count', 'jenis_kelamin');

        $ageCategories = [
            '0-20' => (clone $query)->whereBetween('usia', [0, 20])->count(),
            '21-40' => (clone $query)->whereBetween('usia', [21, 40])->count(),
            '41-60' => (clone $query)->whereBetween('usia', [41, 60])->count(),
            '61+' => (clone $query)->where('usia', '>', 60)->count(),
        ];

        $dailyCounts = (clone $query)
            ->selectRaw('DATE(created_at) as tanggal, COUNT(*) as count')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get()
            ->pluck('count', 'tanggal');

        return response()->json([
            'total' => $totalData,
            'gender' => $genderData,
            'age' => $ageCategories,
            'daily' => $dailyCounts,
        ]);
    }
}
