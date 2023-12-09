<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $pembayaran = Pembayaran::all();
            return response()->json([
                'status' => true,
                'message' => 'Berhasil ambil data',
                'data' => $pembayaran
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
            $pembayaran = Pembayaran::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Berhasil insert data',
                'data' => $pembayaran
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
            $pembayaran = Pembayaran::find($id);

            if (!$pembayaran) {
                throw new \Exception('Barang tidak ditemukan');
            }
            return response()->json([
                'status' => true,
                'message' => 'Berhasil ambil data',
                'data' => $pembayaran
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
            $pembayaran = Pembayaran::find($id);
            if (!$pembayaran) {
                throw new \Exception('Barang tidak ditemukan');
            }

            $pembayaran->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil delete data',
                'data' => $pembayaran
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
     * menampilkan data pembayaran berdasarkan id transaksi 
     * (jadi bisa lihat pembayaran normal dan denda dari transaksi)
     */
    /**
     * Update the password of the certain id
     */
    public function updateDenda(Request $request, $id)
    {
        try {
            $request->only('price');
            $pembayaran = Pembayaran::where('id', $id)->firstOrFail();
            if (!$pembayaran) {
                throw new \Exception('pembayaran not found');
            }

            $pembayaran->update([
                'price' => $request->input('price')
            ]);
            return response()->json([
                'status' => true,
                'message' => 'pembayaran updated successfully',
                'data' => $pembayaran
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
