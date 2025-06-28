<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Groups extends Model
{
    use HasFactory;

    protected $table = 'acl.groups'; // Tabel dengan schema

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'group_name',
        'description',
        'is_publish',
        'is_sub_publish',
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

    protected function casts(): array
    {
        return [
            'is_publish' => 'boolean',
            'is_sub_publish' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function getLabel(): string
    {
        return $this->group_name ?? 'Unnamed Group';
    }
}
