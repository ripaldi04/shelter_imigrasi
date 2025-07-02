<?php

namespace App\Models\Acl;

use App\Models\Employee\Personnel;
use App\Models\Identity\Personal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Gunakan tabel dari schema "acl"
    protected $table = 'acl.users';

    // UUID sebagai primary key
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'id',
        'username',
        'name',
        'email', // ← tambah ini
        'password',
        'is_active',
        'is_change_password',
        'is_admin',
        'description',
        'created_id',
        'created_at',
        'updated_id',
        'updated_at',
    ];

    protected static function booted(): void
    {
        static::creating(function ($user) {
            if (empty($user->id)) {
                $user->id = (string) Str::uuid(); // ← Penting
            }
        });
    }

    // Kolom yang disembunyikan saat serialisasi
    protected $hidden = [
        'password',
    ];

    // Cast kolom sesuai kebutuhan
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // Boleh login ke Filament hanya jika is_admin = '1'
    // public function canAccessFilament(): bool
    // {
    //     return $this->is_admin === '1'; // untuk bpchar(1)
    // }

    public function getFilamentName(): string
    {
        return (string) ($this->name ?? $this->email ?? 'Filament Admin');
    }
    public function personnel()
    {
        return $this->hasOne(Personnel::class, 'user_id', 'id');
    }
    public function personal()
    {
        return $this->hasOne(Personal::class, 'acl_user_id', 'id');
    }



}
