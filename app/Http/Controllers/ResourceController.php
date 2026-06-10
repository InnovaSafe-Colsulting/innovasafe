<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = DB::table('resources_types')
            ->where('status', '1')
            ->orderBy('resource')
            ->get();

        $blogCount = DB::table('blog_resource_details')
            ->where('status', '1')
            ->count();

        $documentsGuia = DB::table('documents_resources_details')
            ->where('status', '1')
            ->where('resource_type_id', 1)
            ->count();

        $documentsDescargables = DB::table('documents_resources_details')
            ->where('status', '1')
            ->where('resource_type_id', 2)
            ->count();

        return view('resources', compact('resources', 'blogCount', 'documentsGuia', 'documentsDescargables'));
    }
}
