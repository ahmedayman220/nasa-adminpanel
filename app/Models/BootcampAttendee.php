<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BootcampAttendee extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable, HasFactory;

    public $table = 'bootcamp_attendees';

    protected $dates = [
        'check_in_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const CATEGORY_RADIO = [
        '0' => 'non_workshop_attendee',
        '1' => 'workshop_attendee',
    ];

    public const ATTENDANCE_STATUS_RADIO = [
        'registered' => 'Registered',
        'attended'   => 'Attended',
    ];

    protected $fillable = [
        'bootcamp_details_id',
        'bootcamp_participant_id',
        'category',
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

    public function bootcamp_details()
    {
        return $this->belongsTo(BootcampDetail::class, 'bootcamp_details_id');
    }

    public function bootcamp_participant()
    {
        return $this->belongsTo(BootcampParticipant::class, 'bootcamp_participant_id');
    }

    public function getCheckInTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setCheckInTimeAttribute($value)
    {
        $this->attributes['check_in_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
