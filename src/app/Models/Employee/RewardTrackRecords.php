<?php

namespace App\Models\Employee;

use App\Models\Public\AwardType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Storage;

class RewardTrackRecords extends Model
{
    use HasFactory;

    protected $table = 'employee.reward_track_records'; // ganti sesuai nama tabel sebenarnya
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'employee_personnel_id',
        'reward_name',
        'award_type_id',
        'institution',
        'year',
        'sk_giver',
        'sk_number',
        'sk_date',
        'description',
        'document_path',
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
        static::deleting(function ($reward) {
            if ($reward->document_path && Storage::disk('public')->exists($reward->document_path)) {
                Storage::disk('public')->delete($reward->document_path);
            }
        });
        static::updating(function ($reward) {
            if ($reward->isDirty('document_path')) {
                $originalPath = $reward->getOriginal('document_path');
                if ($originalPath && Storage::disk('public')->exists($originalPath)) {
                    Storage::disk('public')->delete($originalPath);
                }
            }
        });
    }

    protected $casts = [
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
    ];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'employee_personnel_id');
    }

    public function awardType()
    {
        return $this->belongsTo(AwardType::class, 'award_type_id');
    }
}
