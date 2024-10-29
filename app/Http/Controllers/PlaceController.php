<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Validator;

class PlaceController extends Controller
{
    // Mostrar todos los lugares
    public function index()
    {
        $places = Place::all();
        return response()->json($places);
    }

    // Mostrar un lugar específico por ID
    public function show($id)
    {
        $place = Place::find($id);
        if (!$place) {
            return response()->json(['message' => 'Place not found'], 404);
        }
        return response()->json($place);
    }

    // Crear un nuevo lugar
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string|max:255',
            'route_id' => 'required|exists:routes,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $place = Place::create($request->all());
        return response()->json($place, 201);
    }

    // Actualizar un lugar existente
    public function update(Request $request, $id)
    {
        $place = Place::find($id);

        if (!$place) {
            return response()->json(['message' => 'Place not found'], 404);
        }

        $place->update($request->all());
        return response()->json($place);
    }

    // Eliminar un lugar
    public function destroy($id)
    {
        $place = Place::find($id);

        if (!$place) {
            return response()->json(['message' => 'Place not found'], 404);
        }

        $place->delete();
        return response()->json(['message' => 'Place deleted successfully']);
    }

    // Mostrar todos los lugares de una ruta específica
    public function getPlacesByRoute($routeId)
    {
        $places = Place::where('route_id', $routeId)->get();
        if ($places->isEmpty()) {
            return response()->json(['message' => 'No places found for this route'], 404);
        }
        return response()->json($places);
    }
}
