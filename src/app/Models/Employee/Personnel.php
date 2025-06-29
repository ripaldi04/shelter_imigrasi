<?php
namespace App\Models\Employee;

use App\Models\Instance\Organizations;
use App\Models\Instance\Positions;
use App\Models\Public\Employment;
use App\Models\Public\EmploymentType;
use App\Models\Employee\Assortments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Personnel extends Model
{
    use HasFactory;

    protected $table = 'employee.personnel'; // sesuaikan dengan schema dan table
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'employee_number',
        'old_employee_number',
        'office_email',
        'assignment_letter_path',
        'unor_id',
        'employment_id',
        'assortment_id',
        'position_id',
        'organization_id',
        'employment_type_id',
        'is_verified',
        'is_external',
        'notes',
        'verificator_id',
        'verified_at',
        'responbility_letter_path', 
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
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
    ];

    public function employment()
    {
        return $this->belongsTo(Employment::class, 'employment_id');
    }

    public function assortment()
    {
        return $this->belongsTo(Assortments::class, 'assortment_id');
    }

    public function position()
    {
        return $this->belongsTo(Positions::class, 'position_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organizations::class, 'organization_id');
    }

    public function employmentType()
    {
        return $this->belongsTo(EmploymentType::class, 'employment_type_id');
    }

}
