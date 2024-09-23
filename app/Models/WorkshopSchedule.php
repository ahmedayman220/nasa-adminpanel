<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkshopSchedule extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable, HasFactory;

    public $table = 'workshop_schedules';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'workshop_id',
        'schedule_time',
        'capacity',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function workshopScheduleParticipantWorkshopAssignments()
    {
        return $this->hasMany(ParticipantWorkshopAssignment::class, 'workshop_schedule_id', 'id');
    }

    public function SchedualWorkshopAvailabilityOnSite() {
        return $this->workshopScheduleParticipantWorkshopAssignments()->count() - $this->workshopScheduleParticipantWorkshopAssignments()->where('attendance_status', 'attended')->count();
    }
    public function SchedualWorkshopAvailability() {
        return $this->capacity - $this->workshopScheduleParticipantWorkshopAssignments()->count();
    }
    public function checkSchedualWorkshopAvailability() {
        return $this->capacity > $this->workshopScheduleParticipantWorkshopAssignments()->count();
    }

    public function workshop()
    {
        return $this->belongsTo(Workshop::class, 'workshop_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
