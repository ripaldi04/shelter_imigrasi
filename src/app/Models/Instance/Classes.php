<?php
namespace App\Models\Instance;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'instance.classes';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id',
        'class',
        'performance_allowance',
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
        'updated_at' => 'datetime',
    ];


}
