<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Assortments extends Model
{
    use HasFactory;

    protected $table = 'employee.assortments'; // Jika pakai schema: 'schema.assortment'
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id',
        'code',
        'assortment',
        'description',
        'unor_id',
        'created_id',
        'created_at',
        'updated_id',
        'updated_at',
        'sequence_no',
        'position',
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
        'updated_at' => 'datetime',
        'sequence_no' => 'integer',
    ];
}
