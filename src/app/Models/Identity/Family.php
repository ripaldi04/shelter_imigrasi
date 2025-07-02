<?php

namespace App\Models\Identity;

use App\Models\Public\Relationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Family extends Model
{
    use HasFactory;

    protected $table = 'identity.family';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';


    protected $fillable = [
        'identity_number',
        'full_name',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'description',
        'wedding_date',
        'identity_card',
        'family_card',
        'relationship_card',
        'birth_certificate',
        'blood_type',
        'employee_personnel_id',
        'relationship_id',
        'marital_status_id',
        'degree_id',
        'field_of_study',
        'religion_id',
        'occupation_id',
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
    public function relationship()
    {
        return $this->belongsTo(Relationship::class, 'relationship_id');
    }
    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class, 'marital_status_id');
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class, 'degree_id');
    }

    public function fieldOfStudy()
    {
        return $this->belongsTo(FieldOfStudy::class, 'field_of_study');
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }

    public function occupation()
    {
        return $this->belongsTo(Occupation::class, 'occupation_id');
    }


}
