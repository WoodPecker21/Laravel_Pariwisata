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
use Illuminate\Support\Facades\File;

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

            $user->update($request->all());

            // $photo = $request->imageProfile;
            // $photo = str_replace('data:image/png;base64,', '', $photo);
            // $photo = str_replace(' ', '+', $photo);
            // $photoName = $user->id . '_' . time() . '.png';
            // File::put(public_path() . '/images/' . $photoName, base64_decode($photo));


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

    public function updateImage(Request $request, $id)
    {
        try {
            $user = User::find($id);
            if (!$user) throw new \Exception('User tidak ditemukan');

            $newImage = $request->only('imageProfile');

            $user->update(['imageProfile' => $newImage]);

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
     * Update the password of the certain id
     */
    public function updatePassword(Request $request, $email)
    {
        try {
            $request->only('password');
            $user = User::where('email', $email)->firstOrFail();
            if (!$user) {
                throw new \Exception('User not found');
            }
            $oldPassword = $user->password;
            $newPassword = $request->password;

            if ($oldPassword === $newPassword) {
                return response()->json([
                    'status' => false,
                    'message' => 'Password cannot be the same as the old one',
                    'data' => []
                ], 401);
            }
            $user->update([
                'password' => $request->input('password')
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Password updated successfully',
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
