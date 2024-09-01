@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.participantWorkshopPreference.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.participant-workshop-preferences.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.participantWorkshopPreference.fields.id') }}
                        </th>
                        <td>
                            {{ $participantWorkshopPreference->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.participantWorkshopPreference.fields.bootcamp_participant') }}
                        </th>
                        <td>
                            {{ $participantWorkshopPreference->bootcamp_participant->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.participantWorkshopPreference.fields.workshop') }}
                        </th>
                        <td>
                            {{ $participantWorkshopPreference->workshop->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.participantWorkshopPreference.fields.preference_order') }}
                        </th>
                        <td>
                            {{ App\Models\ParticipantWorkshopPreference::PREFERENCE_ORDER_SELECT[$participantWorkshopPreference->preference_order] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.participant-workshop-preferences.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection