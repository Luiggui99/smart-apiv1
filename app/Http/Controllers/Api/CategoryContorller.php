<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryContorller extends Controller
{
    public function index(){
        $categories = Category::all();
        
        if ($categories->count() > 0){
            return response()->json([
                'status' => 200,
                'cateogires' => $categories
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Se encontraron registros'
            ], 404);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'description' => 'required|string|max:50',
            'status' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => 'Debe cumplir las condiciones',
                'errors' => $validator->messages()
            ], 422);
        } else {
            $category = Category::create([
                'code' => $request->code,
                'description' => $request->description,
                'status' => $request->status,
            ]);
            if($category){
                return response()->json([
                    'status' => 200,
                    'message' => "Categoría creada de forma correcta"
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Algo salió mal"
                ], 500);
            }
        }
    }

    public function show($id){
        $category = Category::find($id);
        if($category){
            return response()->json([
                'status' => 200,
                'category' => $category
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Se encontro la categoría'
            ], 404);
        }
    }

    public function edit($id){
        $category = Category::find($id);
        if($category){
            return response()->json([
                'status' => 200,
                'category' => $category
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No se encontro la categoría'
            ], 404);
        }
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'description' => 'required|string|max:50',
            'status' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => 'Debe cumplir las condiciones',
                'errors' => $validator->messages()
            ], 422);
        } else {
            $category = Category::find($id);
            if($category){
                $category->update([
                    'code' => $request->code,
                    'description' => $request->description,
                    'status' => $request->status,
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => "Categoría actualizada de forma correcta"
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "No se encontro a la categroía"
                ], 404);
            }
        }
    }

    public function destroy($id){
        $category = Category::find($id);
        if($category){
            $category->delete();
            return response()->json([
                'status' => 200,
                'message' => "Categoría eliminada de forma correcta"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No se encontro la categoría'
            ], 404);
        }
    }
}
