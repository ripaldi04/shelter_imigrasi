<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class GroupPermission extends Model
{
    use HasFactory;

    protected $table = 'acl.group_permissions'; // jika menggunakan schema PostgreSQL
    public $incrementing = false;
    protected $primaryKey = 'id';

    protected $keyType = 'string';


    protected $fillable = [
        'group_id',
        'permission_id',
        'is_access',
        'created_id',
        'updated_id',
    ];

    protected $casts = [
        'is_access' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function group()
    {
        return $this->belongsTo(Groups::class,'group_id');
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

}
