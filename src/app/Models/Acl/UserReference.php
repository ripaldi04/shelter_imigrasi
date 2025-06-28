<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class UserReference extends Model
{
    use HasFactory;

    // Tabel dengan schema PostgreSQL
    protected $table = 'acl.user_reference';

    // Primary key bertipe UUID
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'id',
        'user_id',
        'secret',
        'created_id',
        'created_at',
        'updated_id',
        'updated_at',
    ];

    // Casting tipe data otomatis
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    // Relasi ke model User (jika kamu punya model User)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
