<?php

namespace App\Http\Controllers\Identity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Identity\Personal;

class BiodataController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi data
        $validated = $request->validate([
            'full_name' => 'required|string|max:150',
            'front_title' => 'nullable|string|max:50',
            'back_degree' => 'nullable|string|max:50',
            'non_academic_degree' => 'nullable|string|max:50',
            'personal_email' => 'nullable|email|max:150',
            'phone_number' => 'nullable|string|max:20',
            'wa_number' => 'nullable|string|max:20',
            'home_number' => 'nullable|string|max:20',
            'place_of_birth' => 'nullable|string|max:100',
            'blood_type' => 'nullable|string|max:5',
            'identity_address' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|in:1,0',
            'identity_number' => 'nullable|string|max:30',
            'family_identity_number' => 'nullable|string|max:30',
            'photo_path' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'identity_card_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Ambil data personal berdasarkan user
        $personal = $user->personal;

        if (!$personal) {
            $personal = new Personal();
            $personal->acl_user_id = $user->id;

            if (!$user->personnel) {
                return redirect()->back()->with('error', 'Data pegawai belum tersedia.');
            }
            $personal->employee_personnel_id = $user->personnel->id;
        }



        // Isi field dari input
        $personal->fill([
            'full_name' => $validated['full_name'],
            'front_title' => $validated['front_title'] ?? null,
            'back_degree' => $validated['back_degree'] ?? null,
            'non_academic_degree' => $validated['non_academic_degree'] ?? null,
            'personal_email' => $validated['personal_email'] ?? null,
            'phone_number' => $validated['phone_number'] ?? null,
            'wa_number' => $validated['wa_number'] ?? null,
            'home_number' => $validated['home_number'] ?? null,
            'place_of_birth' => $validated['place_of_birth'] ?? null,
            'blood_type' => $validated['blood_type'] ?? null,
            'identity_address' => $validated['identity_address'] ?? null,
            'address' => $validated['address'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'identity_number' => $validated['identity_number'] ?? null,
            'family_identity_number' => $validated['family_identity_number'] ?? null,
        ]);

        // Upload file photo_path
        if ($request->hasFile('photo_path')) {
            // Hapus file lama jika ada
            if ($personal->photo_path && Storage::disk('public')->exists($personal->photo_path)) {
                Storage::disk('public')->delete($personal->photo_path);
            }

            // Simpan file baru
            $path = $request->file('photo_path')->store('uploads/photo', 'public');
            $personal->photo_path = $path;
        }

        // Upload file identity_card_path
        if ($request->hasFile('identity_card_path')) {
            // Hapus file lama jika ada
            if ($personal->identity_card_path && Storage::disk('public')->exists($personal->identity_card_path)) {
                Storage::disk('public')->delete($personal->identity_card_path);
            }

            // Simpan file baru
            $path = $request->file('identity_card_path')->store('uploads/identity_card', 'public');
            $personal->identity_card_path = $path;
        }

        $personal->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }
    public function edit()
    {
        $user = Auth::user();
        return view('biodata', compact('user'));
    }

}
