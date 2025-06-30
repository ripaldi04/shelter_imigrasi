@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto px-6 py-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Buat Akun Baru</h2>

        <form method="POST" action="{{ route('register.store') }}" class="space-y-6">
            @csrf

            {{-- Username --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="username"
                    class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password"
                    class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            {{-- Nama Lengkap --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name"
                    class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email"
                    class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            {{-- Employment --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Employment</label>
                <select name="employment_id"
                    class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="">Pilih Employment</option>
                    @foreach ($employments as $employment)
                        <option value="{{ $employment->id }}">{{ $employment->employment }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Employee Number --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Pegawai</label>
                <input type="text" name="employee_number" value="{{ old('employee_number') }}"
                    class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Assortment --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Assortment</label>
                <select name="assortment_id"
                    class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="">Pilih Assortment</option>
                    @foreach ($assortments as $assortment)
                        <option value="{{ $assortment->id }}">{{ $assortment->assortment }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Position --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                <select name="position_id"
                    class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="">Pilih Position</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->position }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Organization --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Organization</label>
                <select name="organization_id"
                    class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="">Pilih Organization</option>
                    @foreach ($organizations as $org)
                        <option value="{{ $org->id }}">{{ $org->organization }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Employment Type --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Employment Type</label>
                <select name="employment_type_id"
                    class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="">Pilih Type</option>
                    @foreach ($employmentTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Submit Button --}}
            <div>
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-all">
                    Daftar
                </button>
            </div>
        </form>
    </div>
@endsection
