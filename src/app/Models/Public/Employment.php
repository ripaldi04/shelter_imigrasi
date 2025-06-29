<?php

namespace App\Models\Public;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class Employment extends Model
{
    use HasFactory;

    protected $table = 'public.employment';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'employment',
        'description',
        'unor_id',
        'is_active',
        'created_id',
        'created_at',
        'updated_id',
        'update_at',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
    protected $casts = [
        'created_at' => 'datetime',
        'update_at' => 'datetime',
    ];
}
