<?php
namespace App\Models\Employee;

use App\Models\Instance\Organizations;
use App\Models\Employee\Personnel;
use App\Models\Instance\PositionGroups;
use App\Models\Instance\Positions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class PositionTrackRecords extends Model
{
    use HasFactory;

    protected $table = 'employee.position_track_records';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id',
        'employee_personnel_id', // ← Tambahkan ini!
        'organization_id',
        'position_id',
        'grade_id',
        'position_group_id',
        'position_name',
        'unit_name',
        'instance',
        'tmt_date',
        'sk_number',
        'sk_date',
        'description',
        'document_path',
        'is_internal',
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

    public function organization()
    {
        return $this->belongsTo(Organizations::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grades::class);
    }

    public function positionGroup()
    {
        return $this->belongsTo(PositionGroups::class);
    }
    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'employee_personnel_id');
    }
    public function position()
    {
        return $this->belongsTo(Positions::class);
    }
}
