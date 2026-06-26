<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResourceRequest;
use App\Http\Requests\UpdateResourceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    public function index()
    {
        // Obtener recursos de documentos
        $documentResources = DB::table('documents_resources_details')
            ->join('resources_types', 'documents_resources_details.type_resource_id', '=', 'resources_types.id')
            ->select(
                'documents_resources_details.id',
                'documents_resources_details.title',
                DB::raw('NULL as description'),
                DB::raw('NULL as link'),
                DB::raw('NULL as image'),
                'documents_resources_details.path',
                'resources_types.name as type_name',
                'documents_resources_details.status',
                'documents_resources_details.created_at',
                'documents_resources_details.updated_at',
                DB::raw("'document' as source_table")
            );

        // Obtener recursos de blog
        $blogResources = DB::table('blog_resources_details')
            ->select(
                'id',
                'title',
                'description',
                'link',
                'image',
                DB::raw('NULL as path'),
                DB::raw("'Blog' as type_name"),
                'status',
                'created_at',
                'updated_at',
                DB::raw("'blog' as source_table")
            );

        // Unir ambas consultas
        $resources = $documentResources->unionAll($blogResources)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.resources.index', compact('resources'));
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
            if ($validated['type_resource_id'] == 'blog') {
                // Manejar imagen si existe
                $imagePath = null;
                if ($request->hasFile('image')) {
                    $imagePath = $request->file('image')->store('blog-images', 'public');
                }

                DB::table('blog_resources_details')->insert([
                    'title' => $validated['title'],
                    'description' => $validated['description'],
                    'link' => $validated['link'],
                    'image' => $imagePath,
                    'status' => $validated['status'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                // Manejar archivo de documento
                $filePath = null;
                if ($request->hasFile('path')) {
                    $filePath = $request->file('path')->store('documents', 'public');
                }

                DB::table('documents_resources_details')->insert([
                    'title' => $validated['title'],
                    'path' => $filePath,
                    'type_resource_id' => $validated['type_resource_id'],
                    'status' => $validated['status'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return redirect()->route('admin.resources.index')->with('success', 'Recurso creado exitosamente');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al crear el recurso: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id, $type)
    {
        $resourceTypes = DB::table('resources_types')->get();
        
        if ($type == 'blog') {
            $resource = DB::table('blog_resources_details')->where('id', $id)->first();
            $resource->type_resource_id = 'blog';
        } else {
            $resource = DB::table('documents_resources_details')->where('id', $id)->first();
        }

        if (!$resource) {
            return redirect()->route('admin.resources.index')->with('error', 'Recurso no encontrado');
        }

        return view('admin.resources.edit', compact('resource', 'resourceTypes', 'type'));
    }

    public function update(UpdateResourceRequest $request, $id, $type)
    {
        $validated = $request->validated();
        
        try {
            if ($type == 'blog') {
                $updateData = [
                    'title' => $validated['title'],
                    'description' => $validated['description'],
                    'link' => $validated['link'],
                    'status' => $validated['status'],
                    'updated_at' => now(),
                ];

                // Manejar nueva imagen si existe
                if ($request->hasFile('image')) {
                    $oldResource = DB::table('blog_resources_details')->where('id', $id)->first();
                    if ($oldResource && $oldResource->image) {
                        Storage::disk('public')->delete($oldResource->image);
                    }
                    $updateData['image'] = $request->file('image')->store('blog-images', 'public');
                }

                DB::table('blog_resources_details')->where('id', $id)->update($updateData);
            } else {
                $updateData = [
                    'title' => $validated['title'],
                    'type_resource_id' => $validated['type_resource_id'],
                    'status' => $validated['status'],
                    'updated_at' => now(),
                ];

                // Manejar nuevo archivo si existe
                if ($request->hasFile('path')) {
                    $oldResource = DB::table('documents_resources_details')->where('id', $id)->first();
                    if ($oldResource && $oldResource->path) {
                        Storage::disk('public')->delete($oldResource->path);
                    }
                    $updateData['path'] = $request->file('path')->store('documents', 'public');
                }

                DB::table('documents_resources_details')->where('id', $id)->update($updateData);
            }

            return redirect()->route('admin.resources.index')->with('success', 'Recurso actualizado exitosamente');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al actualizar el recurso: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($id, $type)
    {
        try {
            if ($type == 'blog') {
                $resource = DB::table('blog_resources_details')->where('id', $id)->first();
                if ($resource && $resource->image) {
                    Storage::disk('public')->delete($resource->image);
                }
                DB::table('blog_resources_details')->where('id', $id)->delete();
            } else {
                $resource = DB::table('documents_resources_details')->where('id', $id)->first();
                if ($resource && $resource->path) {
                    Storage::disk('public')->delete($resource->path);
                }
                DB::table('documents_resources_details')->where('id', $id)->delete();
            }

            return response()->json(['success' => true, 'message' => 'Recurso eliminado exitosamente']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al eliminar el recurso']);
        }
    }
}