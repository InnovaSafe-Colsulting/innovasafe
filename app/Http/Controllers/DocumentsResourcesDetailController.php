<?php

namespace App\Http\Controllers;

use App\Models\DocumentsResourcesDetail;
use Illuminate\Http\Request;

class DocumentsResourcesDetailController extends Controller
{
    public function index()
    {
        $documentDetails = DocumentsResourcesDetail::where('status', '1')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('documents-resource-details.index', compact('documentDetails'));
    }

    public function show($id)
    {
        $documentDetail = DocumentsResourcesDetail::findOrFail($id);
        return view('documents-resource-details.show', compact('documentDetail'));
    }
}
