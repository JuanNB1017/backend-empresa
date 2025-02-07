<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Helpers;
use App\Models\Colaborator;

class ColaboratorController extends Controller
{
   //function to show all users
    public function index(Helpers $helpers){
        try {
            $colaboradores = Colaborator::all();

            $response = $helpers->checkResponsesByStatus($colaboradores);

            return response()->json($response);
        } catch (\Throwable $th) {
            return response()->json($helpers->throwErrors($th));
        }
    }
    //function to show active/inactive users
    public function SelectByStatus(Request $request, Helpers $helpers){
        try {
            
            if(strval($request->status) != 'activo' && strval($request->status) != 'inactivo'){
                return response()->json([
                    'status' => false,
                    'message' => 'Colaborators not found.',
                    'code' => 404
                ]);
            }

            $colaboradores = Colaborator::where("estatus", $request->status)->get();
            $response = $helpers->checkResponsesByStatus($colaboradores);
            return response()->json($response);
        } catch (\Throwable $th) {
            return response()->json($helpers->throwErrors($th));
        }
    }
    
    //Function for find only one colaborator by ID
    public function FindColaborator (Request $request, Helpers $helpers){
        try {
            $ids = filter_var($request->id, FILTER_VALIDATE_INT);

            if (!$ids) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid Id, check your petition',
                ], 400);
            }
            $colaboradores = Colaborator::where('id', $ids)->first();

            if (!$colaboradores) {
                return response()->json([
                    'status' => false,
                    'message' => 'Colaborator not found.',
                    'code' => 404
                ]);
            }
            
            $response = $helpers->checkResponsesByStatus([$colaboradores]);
            return response()->json($response);

        } catch (\Throwable $th) {
            return response()->json($helpers->throwErrors($th));
        }
    }

    // Update Colaborator information
    public function UpdateColaboratorInfo(Request $request, $id,Helpers $helpers){
        try {
            $colaborador = Colaborator::find($id);

            if (!$colaborador) {
                return response()->json([
                    'status' => false,
                    'data' => 'This collaborator does not exist',
                    'code' => 404
                ]);
            }

            $validator = Validator::make($request->all(), [
                'nombre_completo' => 'required|string|max:100',
                'empresa' => 'required|string|max:80',
                'area' => 'required|string|max:80',
                'departamento' => 'required|string|max:80',
                'puesto' => 'required|string|max:80',
                'fotografia' => 'nullable|string|max:255',
                'estatus' => 'required|in:activo,inactivo',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed. Please check the missing or incorrect fields.',
                    'errors' => $validator->errors(),
                    'code' => 422
                ]);
            }
    
            $colaborador->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'The information about the collaborator has been updated correctly',
                'colaborator' => $colaborador,
                'code' => 200
            ]);
            
        } catch (\Throwable $th) {
            return response()->json($helpers->throwErrors($th));
        }
    }

    //Delete colaborator
    public function DeleteColaborator (Request $request,$id, Helpers $helpers){
        try {
            $colaborador = Colaborator::find($id);  

            if (!$colaborador) {
                return response()->json([
                    'status' => false,
                    'data' => 'This collaborator does not exist',
                    'code' => 404
                ]);
            }
            
            $colaborador->delete();

            return response()->json([
                'status' => true,
                'message' => 'The information about the collaborator has been deleted',
                'colaborator' => $colaborador,
                'code' => 200
            ]);

        } catch (\Throwable $th) {
            return response()->json($helpers->throwErrors($th));
        }
    }

    //Create colaborator
    public function CreateColaborator(Request $request, Helpers $helpers)
    {
        try {
            // Validar los datos
            $validator = Validator::make($request->all(), [
                'nombre_completo' => 'required|string|max:100',
                'empresa' => 'required|string|max:80',
                'area' => 'required|string|max:80',
                'departamento' => 'required|string|max:80',
                'puesto' => 'required|string|max:80',
                'fotografia' => 'nullable|string|max:255',
                'estatus' => 'required|in:activo,inactivo',
            ]);

            // Si la validación falla, retornar errores
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors(),
                    'code' => 422
                ], 422);
            }

            // Crear el colaborador con los datos validados
            $colaborador = Colaborator::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Colaborator successfully created',
                'colaborator' => $colaborador,
                'code' => 201
            ], 201);

        } catch (\Throwable $th) {
            return response()->json($helpers->throwErrors($th));
        }
    }
}
