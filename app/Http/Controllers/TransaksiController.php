<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $transaksi = Transaksi::with(['user', 'bayar', 'objek'])->get();
            return response()->json([
                'status' => true,
                'message' => 'Berhasil ambil data',
                'data' => $transaksi
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
            $transaksi = Transaksi::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Berhasil insert data',
                'data' => $transaksi
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
            $transaksi = Transaksi::with(['user', 'bayar', 'objek'])->find($id);

            if (!$transaksi) {
                throw new \Exception('Transaksi tidak ditemukan');
            }
            return response()->json([
                'status' => true,
                'message' => 'Berhasil ambil data',
                'data' => $transaksi
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
     * Update only for tanggal.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->only([
                'tglStart',
            ]);
            $transaksi = Transaksi::find($id);
            if (!$transaksi) {
                throw new \Exception('Transaksi tidak ditemukan');
            }

            $transaksi->update([
                'password' => $request->input('tglStart')
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Tanggal updated successfully',
                'data' => $transaksi
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
            $transaksi = Transaksi::find($id);
            if (!$transaksi) {
                throw new \Exception('Barang tidak ditemukan');
            }

            $transaksi->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil delete data',
                'data' => $transaksi
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
