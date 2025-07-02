<?php

namespace App\Models\Public;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Occupation extends Model
{
    use HasFactory;

    protected $table = 'public.occupation';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'occupation',
        'description',
        'created_id',
        'created_at',
        'updated_id',
        'updated_at',
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
