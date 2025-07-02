<?php

namespace App\Http\Controllers\Identity;

use App\Http\Controllers\Controller;
use App\Models\Identity\Family;
use App\Models\Public\Degree;
use App\Models\Public\FieldOfStudies;
use App\Models\Public\MaritalStatus;
use App\Models\Public\Occupation;
use App\Models\Public\Relationship;
use App\Models\Public\Religion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FamilyController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $personnelId = $user->personnel->id ?? null;

        return view('family', [
            'families' => \App\Models\Identity\Family::where('employee_personnel_id', $personnelId)->get(),
            'relationships' => Relationship::all(),
            'degrees' => Degree::all(),
            'fields' => FieldOfStudies::all(),
            'occupations' => Occupation::all(),
            'religions' => Religion::all(),
            'maritals' => MaritalStatus::all(),
        ]);
    }


    public function update(Request $request)
    {
        $validated = $request->validate([
            'identity_number' => 'nullable|string|max:16',
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:1,0',
            'place_of_birth' => 'nullable|string|max:100',
            'date_of_birth' => 'nullable|date',
            'description' => 'nullable|string|max:150',
            'wedding_date' => 'nullable|date',
            'blood_type' => 'nullable|string|max:2',
            'relationship_id' => 'required|uuid',
            'marital_status_id' => 'nullable|uuid',
            'degree_id' => 'nullable|uuid',
            'field_of_study_id' => 'nullable|uuid',
            'religion_id' => 'nullable|uuid',
            'occupation_id' => 'nullable|uuid',
            'identity_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'family_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'relationship_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'birth_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        try {
            $user = Auth::user();
            $personnelId = $user->personnel->id ?? null;

            if (!$personnelId) {
                return back()->with('error', 'Data kepegawaian tidak ditemukan.');
            }

            $family = new Family();
            $family->fill($validated);
            $family->employee_personnel_id = $personnelId;
            $family->created_id = $user->id;

            if ($request->hasFile('identity_card')) {
                $family->identity_card = $request->file('identity_card')->store('uploads/identity_card', 'public');
            }
            if ($request->hasFile('family_card')) {
                $family->family_card = $request->file('family_card')->store('uploads/family_card', 'public');
            }
            if ($request->hasFile('relationship_card')) {
                $family->relationship_card = $request->file('relationship_card')->store('uploads/relationship_card', 'public');
            }
            if ($request->hasFile('birth_certificate')) {
                $family->birth_certificate = $request->file('birth_certificate')->store('uploads/birth_certificate', 'public');
            }

            $family->save();

            return redirect()->back()->with('success', 'Data keluarga berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }
    public function update2(Request $request, $id)
    {
        $family = Family::findOrFail($id);

        $data = $request->all();
        $family->update($data);

        return redirect()->back()->with('success', 'Data keluarga berhasil diperbarui.');
    }
    public function destroy($id)
    {
        try {
            $family = Family::findOrFail($id);
            $family->delete();

            return redirect()->back()->with('success', 'Data keluarga berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }


}
