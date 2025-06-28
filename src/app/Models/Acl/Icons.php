<?php
namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Icons extends Model
{
    protected $table = 'acl.icons'; // Ganti sesuai dengan nama tabel dan schema di DB kamu
    public $incrementing = false;
    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'icon_name',
        'groups',
        'pack_name',
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
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
