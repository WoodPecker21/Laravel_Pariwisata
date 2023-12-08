<?php

namespace App\Http\Controllers;

use App\Models\ObjekWisata;
use Illuminate\Http\Request;

class ObjekWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $objekwisata = ObjekWisata::all();
            return response()->json([
                'status' => true,
                'message' => 'Berhasil ambil data',
                'data' => $objekwisata
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $objekwisata = ObjekWisata::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Berhasil insert data',
                'data' => $objekwisata
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $objekwisata = ObjekWisata::find($id);

            if (!$objekwisata) {
                throw new \Exception('Objek Wisata tidak ditemukan');
            }
            return response()->json([
                'status' => true,
                'message' => 'Berhasil ambil data',
                'data' => $objekwisata
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $objekwisata = ObjekWisata::find($id);
            if (!$objekwisata) {
                throw new \Exception('Objek Wisata tidak ditemukan');
            }

            $objekwisata->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Berhasil update data',
                'data' => $objekwisata
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $objekwisata = ObjekWisata::find($id);
            if (!$objekwisata) {
                throw new \Exception('Objek Wisata tidak ditemukan');
            }

            $objekwisata->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil delete data',
                'data' => $objekwisata
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }

    //show by pulau
    public function showByPulau($pulau)
    {
        try {
            $objekwisata = ObjekWisata::where('pulau', $pulau)->get();

            if (!$objekwisata) {
                throw new \Exception('Objek Wisata tidak ditemukan');
            }
            return response()->json([
                'status' => true,
                'message' => 'Berhasil ambil data',
                'data' => $objekwisata
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }
}
