<?php

namespace App\Http\Requests;

use App\Models\ParticipantWorkshopPreference;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateParticipantWorkshopPreferenceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('participant_workshop_preference_edit');
    }

    public function rules()
    {
        return [
            'bootcamp_participant_id' => [
                'required',
                'integer',
            ],
            'workshop_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
