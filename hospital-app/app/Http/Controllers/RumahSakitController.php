<?php

namespace App\Http\Controllers;

use App\Models\RumahSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RumahSakitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rumahSakits = DB::table('rumah_sakits')->orderBy('id', 'desc')->get();
        return view('auth.rumah-sakit.index', compact('rumahSakits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.rumah-sakit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_rumah_sakit' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:rumah_sakits,email',
            'telepon' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('rumah_sakits')->insert([
            'nama_rumah_sakit' => $request->nama_rumah_sakit,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('auth.rumah-sakit.index')
            ->with('success', 'Data rumah sakit berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rumahSakit = DB::table('rumah_sakits')->where('id', $id)->first();

        if (!$rumahSakit) {
            return redirect()->route('auth.rumah-sakit.index')
                ->with('error', 'Data rumah sakit tidak ditemukan!');
        }

        return view('auth.rumah-sakit.show', compact('rumahSakit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rumahSakit = DB::table('rumah_sakits')->where('id', $id)->first();

        if (!$rumahSakit) {
            return redirect()->route('auth.rumah-sakit.index')
                ->with('error', 'Data rumah sakit tidak ditemukan!');
        }

        return view('auth.rumah-sakit.edit', compact('rumahSakit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_rumah_sakit' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:rumah_sakits,email,' . $id,
            'telepon' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $updated = DB::table('rumah_sakits')
            ->where('id', $id)
            ->update([
                'nama_rumah_sakit' => $request->nama_rumah_sakit,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'updated_at' => now(),
            ]);

        if (!$updated) {
            return redirect()->route('auth.rumah-sakit.index')
                ->with('error', 'Data rumah sakit tidak ditemukan!');
        }

        return redirect()->route('auth.rumah-sakit.index')
            ->with('success', 'Data rumah sakit berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleted = DB::table('rumah_sakits')->where('id', $id)->delete();

            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data rumah sakit berhasil dihapus!'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data rumah sakit tidak ditemukan!'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data rumah sakit!'
            ], 500);
        }
    }
}
