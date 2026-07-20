<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypeServiceDetailRequest;
use Illuminate\Support\Facades\DB;

class TypeServiceDetailController extends Controller
{
    public function store(StoreTypeServiceDetailRequest $request)
    {
        $id = DB::table('type_services_detail')->insertGetId([
            'module'          => $request->module,
            'type_module'     => $request->type_module,
            'type_service_id' => $request->type_service_id,
            'status'          => $request->status,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        $record = DB::table('type_services_detail')->where('id', $id)->first();

        return response()->json([
            'success' => true,
            'record'  => $record,
        ], 201);
    }
}
