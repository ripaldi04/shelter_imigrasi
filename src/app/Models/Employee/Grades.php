<?php

namespace App\Models\Employee;

use App\Models\Instance\PositionGroups;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Grades extends Model
{
    use HasFactory;

    protected $table = 'employee.grades'; // sesuaikan dengan schema dan table di DB
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'code',
        'grade',
        'classification',
        'position_group_id',
        'unor_id',
        'level',
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

    public function positionGroup()
    {
        return $this->belongsTo(PositionGroups::class, 'position_group_id');
    }


}
