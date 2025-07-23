<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PropertyApiController extends Controller
{
    // Ambil semua properti
    public function index()
    {
        return response()->json(Property::all(), 200);
    }

    // Tambah properti baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string',
            'location'    => 'required|string',
            'price'       => 'required|numeric',
            'type'        => 'required|string',
            'bedrooms'    => 'required|integer',
            'bathrooms'   => 'required|integer',
            'land_area'   => 'required|numeric',
            'description' => 'nullable|string',
            'status'      => 'in:available,sold',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/properties', 'public');
        }

        $property = Property::create($data);

        return response()->json($property, 201);
    }

    // Tampilkan properti berdasarkan ID
    public function show($id)
    {
        $property = Property::find($id);

        if (!$property) {
            return response()->json(['message' => 'Properti tidak ditemukan'], 404);
        }

        return response()->json($property);
    }

    // Update properti berdasarkan ID
    public function update(Request $request, $id)
    {
        $property = Property::find($id);

        if (!$property) {
            return response()->json(['message' => 'Properti tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'        => 'sometimes|required|string',
            'location'    => 'sometimes|required|string',
            'price'       => 'sometimes|required|numeric',
            'type'        => 'sometimes|required|string',
            'bedrooms'    => 'sometimes|required|integer',
            'bathrooms'   => 'sometimes|required|integer',
            'land_area'   => 'sometimes|required|numeric',
            'description' => 'nullable|string',
            'status'      => 'in:available,sold',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($property->image) {
                Storage::disk('public')->delete($property->image);
            }

            $data['image'] = $request->file('image')->store('images/properties', 'public');
        }

        $property->update($data);

        return response()->json($property);
    }

    // Hapus properti berdasarkan ID
    public function destroy($id)
    {
        $property = Property::find($id);

        if (!$property) {
            return response()->json(['message' => 'Properti tidak ditemukan'], 404);
        }

        if ($property->image) {
            Storage::disk('public')->delete($property->image);
        }

        $property->delete();

        return response()->json(['message' => 'Properti berhasil dihapus']);
    }
}
