<?php

namespace App\Models\Instance;

use App\Models\Instance\Classes;
use App\Models\Employee\Grades;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Positions extends Model
{
    use HasFactory;

    protected $table = 'instance.positions';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'position',
        'grade_id',
        'class_id',
        'unor_id',
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
        'updated_at' => 'datetime',
    ];
    public function grade()
    {
        return $this->belongsTo(Grades::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

}
