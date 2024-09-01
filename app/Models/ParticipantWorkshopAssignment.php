<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParticipantWorkshopAssignment extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable, HasFactory;

    public $table = 'participant_workshop_assignments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const ATTENDANCE_STATUS_SELECT = [
        'assigned' => 'Assigned',
        'absent'   => 'Absent',
        'attended' => 'Attended',
    ];

    protected $fillable = [
        'bootcamp_participant_id',
        'workshop_schedule_id',
        'attendance_status',
        'check_in_time',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function bootcamp_participant()
    {
        return $this->belongsTo(BootcampParticipant::class, 'bootcamp_participant_id');
    }

    public function workshop_schedule()
    {
        return $this->belongsTo(WorkshopSchedule::class, 'workshop_schedule_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
