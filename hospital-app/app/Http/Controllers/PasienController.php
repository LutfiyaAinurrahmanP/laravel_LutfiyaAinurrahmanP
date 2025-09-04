<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('pasiens')
            ->leftJoin('rumah_sakits', 'pasiens.rumah_sakit_id', '=', 'rumah_sakits.id')
            ->select(
                'pasiens.*',
                'rumah_sakits.nama_rumah_sakit'
            );

        // Filter berdasarkan rumah sakit jika ada
        if ($request->filled('rumah_sakit_id')) {
            $query->where('pasiens.rumah_sakit_id', $request->rumah_sakit_id);
        }

        $pasiens = $query->orderBy('pasiens.id', 'desc')->get();

        // Get all rumah sakit untuk dropdown filter
        $rumahSakits = DB::table('rumah_sakits')
            ->orderBy('nama_rumah_sakit', 'asc')
            ->get();

        return view('auth.pasien.index', compact('pasiens', 'rumahSakits'));
    }

    /**
     * AJAX Filter untuk dropdown rumah sakit
     */
    public function filter(Request $request)
    {
        $query = DB::table('pasiens')
            ->leftJoin('rumah_sakits', 'pasiens.rumah_sakit_id', '=', 'rumah_sakits.id')
            ->select(
                'pasiens.*',
                'rumah_sakits.nama_rumah_sakit'
            );

        if ($request->filled('rumah_sakit_id') && $request->rumah_sakit_id != '') {
            $query->where('pasiens.rumah_sakit_id', $request->rumah_sakit_id);
        }

        $pasiens = $query->orderBy('pasiens.id', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $pasiens
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rumahSakits = DB::table('rumah_sakits')
            ->orderBy('nama_rumah_sakit', 'asc')
            ->get();

        return view('auth.pasien.create', compact('rumahSakits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pasien' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telpon' => 'required|string|max:20',
            'rumah_sakit_id' => 'required|exists:rumah_sakits,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('pasiens')->insert([
            'nama_pasien' => $request->nama_pasien,
            'alamat' => $request->alamat,
            'no_telpon' => $request->no_telpon,
            'rumah_sakit_id' => $request->rumah_sakit_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('auth.pasien.index')
            ->with('success', 'Data pasien berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pasien = DB::table('pasiens')
            ->leftJoin('rumah_sakits', 'pasiens.rumah_sakit_id', '=', 'rumah_sakits.id')
            ->select(
                'pasiens.*',
                'rumah_sakits.nama_rumah_sakit',
                'rumah_sakits.alamat as alamat_rumah_sakit',
                'rumah_sakits.email as email_rumah_sakit',
                'rumah_sakits.telepon as telepon_rumah_sakit'
            )
            ->where('pasiens.id', $id)
            ->first();

        if (!$pasien) {
            return redirect()->route('auth.pasien.index')
                ->with('error', 'Data pasien tidak ditemukan!');
        }

        return view('auth.pasien.show', compact('pasien'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pasien = DB::table('pasiens')->where('id', $id)->first();

        if (!$pasien) {
            return redirect()->route('auth.pasien.index')
                ->with('error', 'Data pasien tidak ditemukan!');
        }

        $rumahSakits = DB::table('rumah_sakits')
            ->orderBy('nama_rumah_sakit', 'asc')
            ->get();

        return view('auth.pasien.edit', compact('pasien', 'rumahSakits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_pasien' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telpon' => 'required|string|max:20',
            'rumah_sakit_id' => 'required|exists:rumah_sakits,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $updated = DB::table('pasiens')
            ->where('id', $id)
            ->update([
                'nama_pasien' => $request->nama_pasien,
                'alamat' => $request->alamat,
                'no_telpon' => $request->no_telpon,
                'rumah_sakit_id' => $request->rumah_sakit_id,
                'updated_at' => now(),
            ]);

        if (!$updated) {
            return redirect()->route('auth.pasien.index')
                ->with('error', 'Data pasien tidak ditemukan!');
        }

        return redirect()->route('auth.pasien.index')
            ->with('success', 'Data pasien berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleted = DB::table('pasiens')->where('id', $id)->delete();

            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data pasien berhasil dihapus!'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data pasien tidak ditemukan!'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data pasien!'
            ], 500);
        }
    }
}
