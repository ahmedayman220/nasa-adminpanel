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

class BootcampParticipant extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'bootcamp_participants';

    protected $appends = [
        'national_id_front',
        'national_id_back',
    ];

    public const IS_PARTICIPATED_RADIO = [
        '0' => 'No',
        '1' => 'Yes',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const IS_ATTEND_FORMATION_ACTIVITY_RADIO = [
        '0' => 'No',
        '1' => 'Yes',
    ];

    public const IS_HAVE_TEAM_RADIO = [
        '0' => 'No',
        '1' => 'Yes',
        '2' => 'Yes, but still searching  for members',
    ];

    protected $fillable = [
        'uuid',
        'name_en',
        'name_ar',
        'email',
        'age',
        'phone_number',
        'educational_level_id',
        'field_of_study_id',
        'educational_institute',
        'graduation_year',
        'position',
        'national',
        'is_participated',
        'participated_year',
        'is_attend_formation_activity',
        'first_priority_id',
        'second_priority_id',
        'third_priority_id',
        'why_this_workshop',
        'is_have_team',
        'comment',
        'year',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
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

    public function bootcampParticipantParticipantWorkshopAssignments()
    {
        return $this->hasMany(ParticipantWorkshopAssignment::class, 'bootcamp_participant_id', 'id');
    }

    public function bootcampParticipantParticipantWorkshopPreferences()
    {
        return $this->hasMany(ParticipantWorkshopPreference::class, 'bootcamp_participant_id', 'id');
    }

    public function bootcampParticipantBootcampAttendees()
    {
        return $this->hasMany(BootcampAttendee::class, 'bootcamp_participant_id', 'id');
    }

    public function bootcampParticipantQrCodes()
    {
        return $this->hasMany(QrCode::class, 'bootcamp_participant_id', 'id');
    }

    public function bootcampParticipantEmailEmails()
    {
        return $this->hasMany(Email::class, 'bootcamp_participant_email_id', 'id');
    }

    public function educational_level()
    {
        return $this->belongsTo(EducationLevel::class, 'educational_level_id');
    }

    public function field_of_study()
    {
        return $this->belongsTo(MentionYourField::class, 'field_of_study_id');
    }

    public function getNationalIdFrontAttribute()
    {
        $file = $this->getMedia('national_id_front')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getNationalIdBackAttribute()
    {
        $file = $this->getMedia('national_id_back')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    // Function to generate a unique 4-digit UUID
    protected static function generateUniqueFourDigitUuid()
    {
        do {
            // Generate a 4-digit number
            $uuid = mt_rand(1000, 9999);
        } while (self::where('uuid', $uuid)->exists()); // Check if the UUID already exists

        return $uuid;
    }


    public function first_priority()
    {
        return $this->belongsTo(Workshop::class, 'first_priority_id');
    }

    public function second_priority()
    {
        return $this->belongsTo(Workshop::class, 'second_priority_id');
    }

    public function third_priority()
    {
        return $this->belongsTo(Workshop::class, 'third_priority_id');
    }

    public function emailBootcampConfirmations()
    {
        return $this->hasMany(BootcampConfirmation::class, 'email_id', 'id');
    }

    public function nationalBootcampConfirmations()
    {
        return $this->hasMany(BootcampConfirmation::class, 'national_id', 'id');
    }
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
