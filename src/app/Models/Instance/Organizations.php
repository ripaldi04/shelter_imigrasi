<?php
namespace App\Models\Instance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class Organizations extends Model
{
    use HasFactory;

    protected $table = 'instance.organizations';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'organization_code',
        'organization',
        'group_id',
        'parent_id',
        'province_id',
        'time_zone',
        'city_id',
        'unor_id',
        'is_demo',
        'is_active',
        'organization_code_kemenkeu',
        'organization_kemenkeu',
        'organization_code_bapenas',
        'organization_bapenas',
        'organization_code_anri',
        'organization_anri',
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
