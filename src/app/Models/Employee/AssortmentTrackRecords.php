<?php

namespace App\Models\Employee;

use App\Models\Public\Employment;
use App\Models\Public\PromotionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class AssortmentTrackRecords extends Model
{
    use HasFactory;

    protected $table = 'employee.assortment_track_records';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id',
        'tmt_date',
        'work_period_month',
        'work_period_year',
        'sk_number',
        'description',
        'document_path',
        'employee_personnel_id',
        'employment_id',
        'assortment_id',
        'promotion_type_id',
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
        'sequence_no' => 'integer',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = $model->id ?? (string) Str::uuid();
        });
    }

    // Relasi (jika ada)
    public function employee()
    {
        return $this->belongsTo(Personnel::class, 'employee_personnel_id');
    }

    public function employment()
    {
        return $this->belongsTo(Employment::class);
    }

    public function assortment()
    {
        return $this->belongsTo(Assortments::class);
    }

    public function promotionType()
    {
        return $this->belongsTo(PromotionType::class);
    }
}
