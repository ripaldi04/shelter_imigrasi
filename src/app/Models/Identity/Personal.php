<?php

namespace App\Models\Identity;

use App\Models\Acl\User;
use App\Models\Employee\Personnel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Personal extends Model
{
    use HasFactory;

    protected $table = 'identity.personal';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';


    protected $fillable = [
        'full_name',
        'front_title',
        'back_degree',
        'non_academic_degree',
        'personal_email',
        'phone_number',
        'wa_number',
        'home_number',
        'place_of_birth',
        'date_of_birth',
        'blood_type',
        'identity_address',
        'address',
        'gender',
        'identity_number',
        'family_identity_number',
        'photo_path',
        'identity_card_path',
        'acl_user_id',
        'employee_personnel_id',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'acl_user_id');
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'employee_personnel_id');
    }
}
