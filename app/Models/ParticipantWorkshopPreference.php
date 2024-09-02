<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParticipantWorkshopPreference extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable, HasFactory;

    public $table = 'participant_workshop_preferences';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const PREFERENCE_ORDER_SELECT = [
        '1' => '1',
        '2' => '2',
        '3' => '3',
    ];

    protected $fillable = [
        'bootcamp_participant_id',
        'workshop_id',
        'preference_order',
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

    public function workshop()
    {
        return $this->belongsTo(Workshop::class, 'workshop_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
