<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

class Member extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'members';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const PARTICIPANT_TYPE_SELECT = [
        'onsite' => 'Onsite',
        'online' => 'Online',
    ];

    public const MEMBER_ROLE_SELECT = [
        'member'    => 'Member',
        'team_lead' => 'Team Lead',
    ];

    protected $fillable = [
        'uuid',
        'national',
        'name',
        'email',
        'phone_number',
        'age',
        'is_new',
        'major_id',
        'organization',
        'participant_type',
        'study_level_id',
        'tshirt_size_id',
        'qr_code_id',
        'member_role',
        'extra_field',
        'notes',
        'transportation_id',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function teamLeaderTeams()
    {
        return $this->hasMany(Team::class, 'team_leader_id', 'id');
    }

    public function memberMemberCheckpoints()
    {
        return $this->hasMany(MemberCheckpoint::class, 'member_id', 'id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id');
    }

    public function study_level()
    {
        return $this->belongsTo(StudyLevelss::class, 'study_level_id');
    }

    public function tshirt_size()
    {
        return $this->belongsTo(TshirtSize::class, 'tshirt_size_id');
    }

    public function qr_code()
    {
        return $this->belongsTo(QrCode::class, 'qr_code_id');
    }

    public function transportation()
    {
        return $this->belongsTo(Transportation::class, 'transportation_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    protected static function generateUniqueFourDigitUuid()
    {
        do {
            // Generate a 4-digit number
            $uuid = mt_rand(1000, 9999);
        } while (self::where('uuid', $uuid)->exists()); // Check if the UUID already exists

        return $uuid;
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = $this->generateUniqueFourDigitUuid(); // Generate a unique 4-digit UUID
        });
    }

}
