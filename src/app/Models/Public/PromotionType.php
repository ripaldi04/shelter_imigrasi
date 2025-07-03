<?php

namespace App\Models\Public;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class PromotionType extends Model
{
    use HasFactory;

    protected $table = 'public.promotion_type';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id',
        'name',
        'description',
        'unor_id',
        'created_id',
        'updated_id',
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
