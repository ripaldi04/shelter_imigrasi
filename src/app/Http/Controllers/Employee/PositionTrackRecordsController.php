<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee\Grades;
use App\Models\Instance\Organizations;
use App\Models\Instance\PositionGroups;
use App\Models\Instance\Positions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Employee\PositionTrackRecords;
use Log;

class PositionTrackRecordsController extends Controller
{
    public function index()
    {
        $dataJabatan = PositionTrackRecords::with([
            'position',
            'organization',
            'grade',
            'positionGroup'
        ])
            ->where('employee_personnel_id', auth()->user()->personnel->id)
            ->orderByDesc('tmt_date')
            ->get();

        return view('position_track_records', [
            'dataJabatan' => $dataJabatan,
            'positionList' => Positions::all(),
            'organizationList' => Organizations::all(),
            'gradeList' => Grades::all(),
            'positionGroupList' => PositionGroups::all(),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'position_id' => 'required|uuid',
            'organization_id' => 'nullable|uuid',
            'grade_id' => 'nullable|uuid',
            'position_group_id' => 'nullable|uuid',
            'position_name' => 'required|string|max:150',
            'unit_name' => 'nullable|string|max:150',
            'instance' => 'nullable|string|max:150',
            'tmt_date' => 'required|date',
            'sk_number' => 'nullable|string|max:100',
            'sk_date' => 'nullable|date',
            'description' => 'nullable|string',
            'document_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'is_internal' => 'required|in:0,1',
        ]);

        $filePath = null;
        if ($request->hasFile('document_path')) {
            $filePath = $request->file('document_path')->store('uploads/position_track', 'public');
        }

        PositionTrackRecords::create([
            'id' => Str::uuid(),
            'employee_personnel_id' => auth()->user()->personnel->id ?? null,
            'position_id' => $request->position_id,
            'organization_id' => $request->organization_id,
            'grade_id' => $request->grade_id,
            'position_group_id' => $request->position_group_id,
            'position_name' => $request->position_name,
            'unit_name' => $request->unit_name,
            'instance' => $request->instance,
            'tmt_date' => $request->tmt_date,
            'sk_number' => $request->sk_number,
            'sk_date' => $request->sk_date,
            'description' => $request->description,
            'document_path' => $filePath,
            'is_internal' => $request->is_internal,
            'created_id' => auth()->id(),
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Data jabatan berhasil disimpan.');
    }
    public function update(Request $request, $id)
    {
        $jabatan = PositionTrackRecords::findOrFail($id);

        $validated = $request->validate([
            'position_id' => 'required|uuid',
            'organization_id' => 'nullable|uuid',
            'grade_id' => 'nullable|uuid',
            'position_group_id' => 'nullable|uuid',
            'position_name' => 'required|string|max:150',
            'unit_name' => 'nullable|string|max:150',
            'instance' => 'nullable|string|max:150',
            'tmt_date' => 'required|date',
            'sk_number' => 'nullable|string|max:100',
            'sk_date' => 'nullable|date',
            'description' => 'nullable|string',
            'document_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'is_internal' => 'required|in:0,1',
        ]);

        // Handle dokumen baru
        if ($request->hasFile('document_path')) {
            // Hapus file lama
            if ($jabatan->document_path && Storage::disk('public')->exists($jabatan->document_path)) {
                Storage::disk('public')->delete($jabatan->document_path);
            }

            // Upload file baru
            $validated['document_path'] = $request->file('document_path')->store('uploads/position_track', 'public');

            Log::info('File SK diperbarui:', [
                'new_path' => $validated['document_path'],
                'full_path' => Storage::disk('public')->path($validated['document_path']),
            ]);
        }

        $validated['updated_id'] = auth()->id();
        $validated['updated_at'] = now();

        $jabatan->update($validated);

        return redirect()->back()->with('success', 'Data jabatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jabatan = PositionTrackRecords::findOrFail($id);

        // Hapus dokumen jika ada
        if ($jabatan->document_path && Storage::disk('public')->exists($jabatan->document_path)) {
            Storage::disk('public')->delete($jabatan->document_path);
        }

        $jabatan->delete();

        return redirect()->back()->with('success', 'Data jabatan berhasil dihapus.');
    }

}
