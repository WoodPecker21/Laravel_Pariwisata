<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = User::all();
            return response()->json([
                'status' => true,
                'message' => 'Berhasil ambil data',
                'data' => $user
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

            $user = User::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Berhasil insert data',
                'data' => $user
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
            $user = User::find($id);

            if (!$user) {
                throw new \Exception('Barang tidak ditemukan');
            }
            return response()->json([
                'status' => true,
                'message' => 'Berhasil ambil data',
                'data' => $user
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
            $user = User::find($id);
            if (!$user) {
                throw new \Exception('Barang tidak ditemukan');
            }
            $validator = Validator::make($request->all(), [
                'imageProfile' => 'nullable:jpeg,png,jpg|max:2048' //2 mb=2048
            ]);
            if ($validator->fails())
                return response(['message' => $validator->errors()], 400);

            // utk simpan ke img ke storage/app/public/img
            //nanti di database image disimpan sbg string
            $image = $request->file('imageProfile');
            $uploadFolder = 'img';
            $image_uploaded_path = $image->store($uploadFolder, 'public');
            $uploadedimg =  basename($image_uploaded_path);

            $user->update(array_merge($request->all(), ['imageProfile' => $uploadedimg]));

            return response()->json([
                'status' => true,
                'message' => 'Berhasil update data',
                'data' => $user
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
            $user = User::find($id);
            if (!$user) {
                throw new \Exception('Barang tidak ditemukan');
            }

            $user->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil delete data',
                'data' => $user
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
