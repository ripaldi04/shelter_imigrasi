<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee\Assortments;
use App\Models\Employee\AssortmentTrackRecords;
use App\Models\Public\Employment;
use App\Models\Public\PromotionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Identity\RankHistory;
use Log;

class AssortmentTrackRecordsController extends Controller
{
    public function index()
    {
        $assortments = Assortments::all();
        $employments = Employment::all();
        $promotionTypes = PromotionType::all();

        $employeePersonnelId = auth()->user()->personnel->id ?? null;

        // Ambil data rekam jejak milik user yang sedang login
        $trackRecords = AssortmentTrackRecords::with(['assortment', 'employment', 'promotionType'])
            ->where('employee_personnel_id', $employeePersonnelId)
            ->orderByDesc('tmt_date')
            ->get();

        return view('assortment_track_records', compact(
            'assortments',
            'employments',
            'promotionTypes',
            'employeePersonnelId',
            'trackRecords'
        ));
    }


    public function store(Request $request)
    {
        // dd($request->all(), $request->file('document_path'));

        $validator = Validator::make($request->all(), [
            'tmt_date' => 'required|date',
            'work_period_month' => 'required|numeric|min:0',
            'work_period_year' => 'required|numeric|min:0',
            'sk_number' => 'nullable|string|max:150',
            'description' => 'nullable|string|max:1000',
            'document_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',

            'assortment_id' => 'required|uuid',
            'employment_id' => 'required|uuid',
            'promotion_type_id' => 'required|uuid',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Handle file upload
        $path = null;
        if ($request->hasFile('document_path')) {
            $file = $request->file('document_path');
            $path = $file->store('uploads/rank_documents', 'public');
        }


        // Simpan ke DB
        try {
            $model = AssortmentTrackRecords::create([
                'id' => Str::uuid(),
                'tmt_date' => $request->input('tmt_date'),
                'work_period_month' => $request->input('work_period_month'),
                'work_period_year' => $request->input('work_period_year'),
                'sk_number' => $request->input('sk_number'),
                'description' => $request->input('description'),
                'document_path' => $path,
                'employee_personnel_id' => optional(auth()->user()->personnel)->id,
                'employment_id' => $request->input('employment_id'),
                'assortment_id' => $request->input('assortment_id'),
                'promotion_type_id' => $request->input('promotion_type_id'),
            ]);
            Log::info('Record created successfully', ['id' => $model->id]);
            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan rekam jejak', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tmt_date' => 'required|date',
            'work_period_month' => 'required|numeric|min:0',
            'work_period_year' => 'required|numeric|min:0',
            'sk_number' => 'nullable|string|max:150',
            'description' => 'nullable|string|max:1000',
            'document_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'assortment_id' => 'required|uuid',
            'employment_id' => 'required|uuid',
            'promotion_type_id' => 'required|uuid',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $record = AssortmentTrackRecords::findOrFail($id);
            $path = $record->document_path;

            if ($request->hasFile('document_path')) {
                // Hapus file lama jika ada
                if ($path && \Storage::disk('public')->exists($path)) {
                    \Storage::disk('public')->delete($path);
                }

                // Upload file baru
                $file = $request->file('document_path');
                $path = $file->store('uploads/rank_documents', 'public');
            }

            $record->update([
                'tmt_date' => $request->input('tmt_date'),
                'work_period_month' => $request->input('work_period_month'),
                'work_period_year' => $request->input('work_period_year'),
                'sk_number' => $request->input('sk_number'),
                'description' => $request->input('description'),
                'document_path' => $path,
                'assortment_id' => $request->input('assortment_id'),
                'employment_id' => $request->input('employment_id'),
                'promotion_type_id' => $request->input('promotion_type_id'),
            ]);

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $record = AssortmentTrackRecords::findOrFail($id);

            // Hapus file dari storage jika ada
            if ($record->document_path && \Storage::disk('public')->exists($record->document_path)) {
                \Storage::disk('public')->delete($record->document_path);
            }

            $record->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

}
