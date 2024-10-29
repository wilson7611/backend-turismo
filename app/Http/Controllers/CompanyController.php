<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
   // Mostrar todas las compañías
   public function index()
   {
       $companies = Company::all();
       return response()->json($companies);
   }

   // Mostrar una compañía específica por ID
   public function show($id)
   {
       $company = Company::find($id);
       if (!$company) {
           return response()->json(['message' => 'Company not found'], 404);
       }
       return response()->json($company);
   }

   // Crear una nueva compañía
   public function store(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'name' => 'required|string|max:255',
           'address' => 'required|string|max:255',
           'contact' => 'required|string|max:255',
           'user_id' => 'required|exists:users,id',
       ]);

       if ($validator->fails()) {
           return response()->json($validator->errors(), 422);
       }

       $company = Company::create($request->all());
       return response()->json($company, 201);
   }

   // Actualizar una compañía existente
   public function update(Request $request, $id)
   {
       $company = Company::find($id);

       if (!$company) {
           return response()->json(['message' => 'Company not found'], 404);
       }

       $company->update($request->all());
       return response()->json($company);
   }

   // Eliminar una compañía
   public function destroy($id)
   {
       $company = Company::find($id);

       if (!$company) {
           return response()->json(['message' => 'Company not found'], 404);
       }

       $company->delete();
       return response()->json(['message' => 'Company deleted successfully']);
   }
}
