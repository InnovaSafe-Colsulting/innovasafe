<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::where('status', '1')->get();
        
        // Obtener servicios
        $typeServices = DB::table('type_services')->get();
        
        // Obtener detalles de módulos para SST (ID = 1)
        $sstModules = DB::table('type_services_detail')
            ->where('type_service_id', 1)
            ->where('status', '1')
            ->get()
            ->groupBy('type_module');
        
        return view('plans', compact('plans', 'typeServices', 'sstModules'));
    }
    
    public function getPlansApi(Request $request)
    {
        $query = Plan::where('status', '1');
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }
        
        $plans = $query->get(['id', 'name', 'description', 'prize']);
        
        return response()->json($plans);
    }
}
