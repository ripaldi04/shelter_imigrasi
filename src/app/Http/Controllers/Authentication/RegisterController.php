<?php
namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\Acl\User;
use App\Models\Public\Employment;
use App\Models\Employee\Assortments;
use App\Models\Instance\Positions;
use App\Models\Instance\Organizations;
use App\Models\Public\EmploymentType;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;



class RegisterController extends Controller
{

    public function create()
    {
        return view('auth.register', [
            'employments' => Employment::all(),
            'assortments' => Assortments::all(),
            'positions' => Positions::all(),
            'organizations' => Organizations::all(),
            'employmentTypes' => EmploymentType::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => [
                'required',
                function ($attribute, $value, $fail) {
                    $exists = DB::table('acl.users')->where('username', $value)->exists();
                    if ($exists) {
                        $fail('Username sudah digunakan.');
                    }
                },
            ],
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    $exists = DB::table('acl.users')->where('email', $value)->exists();
                    if ($exists) {
                        $fail('Email sudah digunakan.');
                    }
                },
            ],
            'password' => 'required|min:6',
            'name' => 'required',
            'employment_id' => 'required|uuid',
            'assortment_id' => 'required|uuid',
            'position_id' => 'required|uuid',
            'organization_id' => 'required|uuid',
            'employment_type_id' => 'required|uuid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        // Simpan user
        User::create([
            'username' => $validated['username'],
            'password' => bcrypt($validated['password']),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'employment_id' => $validated['employment_id'],
            'assortment_id' => $validated['assortment_id'],
            'position_id' => $validated['position_id'],
            'organization_id' => $validated['organization_id'],
            'employment_type_id' => $validated['employment_type_id'],
        ]);

        return redirect()->route('home')->with('success', 'Registrasi berhasil!');
    }

}
