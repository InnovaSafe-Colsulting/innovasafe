<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResourceRequest;
use App\Http\Requests\UpdateResourceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ResourceController extends Controller
{
    public function publicIndex()
    {
        $user = auth()->user();
        $isClient = $user && $user->role_id != 1;
        $limit = $isClient ? null : 3;

        $blogsQ        = DB::table('blog_resource_details')->where('status', 1)->orderBy('created_at', 'desc');
        $guiasQ        = DB::table('documents_resources_details')->where('resource_type_id', 1)->where('status', 1)->orderBy('created_at', 'desc');
        $descargablesQ = DB::table('documents_resources_details')->where('resource_type_id', 2)->where('status', 1)->orderBy('created_at', 'desc');

        $blogsTotal        = $blogsQ->count();
        $guiasTotal        = $guiasQ->count();
        $descargablesTotal = $descargablesQ->count();

        $blogs        = $limit ? $blogsQ->limit($limit)->get() : $blogsQ->get();
        $guias        = $limit ? $guiasQ->limit($limit)->get() : $guiasQ->get();
        $descargables = $limit ? $descargablesQ->limit($limit)->get() : $descargablesQ->get();

        return view('resources', compact('blogs', 'guias', 'descargables', 'isClient', 'blogsTotal', 'guiasTotal', 'descargablesTotal'));
    }

    public function index()
    {
        $resourceTypes = DB::table('resources_types')->get();

        $blogs = DB::table('blog_resource_details')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($r) {
                $r->source_table = 'blog';
                $r->type_name = 'Blog';
                $r->created_at = $r->created_at ? Carbon::parse($r->created_at)->format('d/m/Y H:i') : '-';
                return $r;
            });

        $documents = DB::table('documents_resources_details')
            ->join('resources_types', 'documents_resources_details.resource_type_id', '=', 'resources_types.id')
            ->select('documents_resources_details.*', 'resources_types.resource as type_name', 'resources_types.id as type_id')
            ->orderBy('documents_resources_details.created_at', 'desc')
            ->get()
            ->map(function ($r) {
                $r->source_table = 'document';
                $r->created_at = $r->created_at ? Carbon::parse($r->created_at)->format('d/m/Y H:i') : '-';
                return $r;
            });

        return view('admin.resources.index', compact('blogs', 'documents', 'resourceTypes'));
    }

    public function create()
    {
        $resourceTypes = DB::table('resources_types')->get();
        return view('admin.resources.create', compact('resourceTypes'));
    }

    public function store(StoreResourceRequest $request)
    {
        $validated = $request->validated();

        try {
            $blogTypeId = DB::table('resources_types')->where('resource', 'Blog')->value('id');
        if ((string)$validated['type_resource_id'] === (string)$blogTypeId) {
                $imagePath = null;
                if ($request->hasFile('image')) {
                    $imagePath = $request->file('image')->store('blog-images', 'public');
                }
                DB::table('blog_resource_details')->insert([
                    'title'       => $validated['title'],
                    'description' => $validated['description'],
                    'url_link'    => $validated['url_link'],
                    'image'       => $imagePath,
                    'status'      => $validated['status'],
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            } else {
                $filePath = null;
                if ($request->hasFile('path')) {
                    $filePath = $request->file('path')->store('documents', 'public');
                }
                DB::table('documents_resources_details')->insert([
                    'title'            => $validated['title'],
                    'path'             => $filePath,
                    'resource_type_id' => $validated['type_resource_id'],
                    'status'           => $validated['status'],
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ]);
            }

            return redirect()->route('filament.admin.pages.recursos-page')->with('success', 'Recurso creado exitosamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al crear el recurso: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id, $type)
    {
        $resourceTypes = DB::table('resources_types')->get();

        if ($type == 'blog') {
            $resource = DB::table('blog_resource_details')->where('id', $id)->first();
        } else {
            $resource = DB::table('documents_resources_details')->where('id', $id)->first();
        }

        if (!$resource) {
            return redirect()->route('admin.resources.index')->with('error', 'Recurso no encontrado.');
        }

        return view('filament.pages.recursos.edit', compact('resource', 'resourceTypes', 'type'));
    }

    public function update(UpdateResourceRequest $request, $id, $type)
    {
        $validated = $request->validated();

        try {
            if ($type == 'blog') {
                $updateData = [
                    'title'       => $validated['title'],
                    'description' => $validated['description'],
                    'url_link'    => $validated['url_link'],
                    'status'      => $validated['status'],
                    'updated_at'  => now(),
                ];
                if ($request->hasFile('image')) {
                    $old = DB::table('blog_resource_details')->where('id', $id)->first();
                    if ($old && $old->image) Storage::disk('public')->delete($old->image);
                    $updateData['image'] = $request->file('image')->store('blog-images', 'public');
                }
                DB::table('blog_resource_details')->where('id', $id)->update($updateData);
            } else {
                $updateData = [
                    'title'            => $validated['title'],
                    'resource_type_id' => $validated['type_resource_id'],
                    'status'           => $validated['status'],
                    'updated_at'       => now(),
                ];
                if ($request->hasFile('path')) {
                    $old = DB::table('documents_resources_details')->where('id', $id)->first();
                    if ($old && $old->path) Storage::disk('public')->delete($old->path);
                    $updateData['path'] = $request->file('path')->store('documents', 'public');
                }
                DB::table('documents_resources_details')->where('id', $id)->update($updateData);
            }

            return redirect()->route('filament.admin.pages.recursos-page')->with('success', 'Recurso actualizado exitosamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al actualizar: ' . $e->getMessage()])->withInput();
        }
    }

    public function toggleStatus(Request $request, $id, $type)
    {
        try {
            $status = $request->input('status');
            $table  = $type == 'blog' ? 'blog_resource_details' : 'documents_resources_details';
            DB::table($table)->where('id', $id)->update(['status' => $status, 'updated_at' => now()]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }

    public function destroy($id, $type)
    {
        try {
            if ($type == 'blog') {
                $resource = DB::table('blog_resource_details')->where('id', $id)->first();
                if ($resource && $resource->image) Storage::disk('public')->delete($resource->image);
                DB::table('blog_resource_details')->where('id', $id)->delete();
            } else {
                $resource = DB::table('documents_resources_details')->where('id', $id)->first();
                if ($resource && $resource->path) Storage::disk('public')->delete($resource->path);
                DB::table('documents_resources_details')->where('id', $id)->delete();
            }
            return response()->json(['success' => true, 'message' => 'Elemento borrado con éxito.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al eliminar el recurso.']);
        }
    }
}   