<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\Property;
use Illuminate\Support\Facades\Validator;

class BuyerApiController extends Controller
{
    // Ambil semua buyer
    public function index()
    {
        $buyers = Buyer::with('property')->get();
        return response()->json($buyers);
    }

    // Tambah buyer baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:buyers,email',
            'phone'       => 'required|string|max:20',
            'property_id' => 'required|exists:properties,id',
            'status'      => 'in:pending,approved,rejected',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $buyer = Buyer::create($request->all());
        return response()->json($buyer, 201);
    }

    // Tampilkan buyer berdasarkan ID
    public function show($id)
    {
        $buyer = Buyer::with('property')->find($id);

        if (!$buyer) {
            return response()->json(['message' => 'Buyer tidak ditemukan'], 404);
        }

        return response()->json($buyer);
    }

    // Update buyer
    public function update(Request $request, $id)
    {
        $buyer = Buyer::find($id);

        if (!$buyer) {
            return response()->json(['message' => 'Buyer tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'        => 'sometimes|required|string|max:255',
            'email'       => 'sometimes|required|email|unique:buyers,email,' . $buyer->id,
            'phone'       => 'sometimes|required|string|max:20',
            'property_id' => 'sometimes|required|exists:properties,id',
            'status'      => 'in:pending,approved,rejected',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $buyer->update($request->all());

        return response()->json($buyer);
    }

    // Hapus buyer
    public function destroy($id)
    {
        $buyer = Buyer::find($id);

        if (!$buyer) {
            return response()->json(['message' => 'Buyer tidak ditemukan'], 404);
        }

        $buyer->delete();

        return response()->json(['message' => 'Buyer berhasil dihapus']);
    }
}
