@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.email.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.emails.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.email.fields.id') }}
                        </th>
                        <td>
                            {{ $email->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.email.fields.qrcode') }}
                        </th>
                        <td>
                            {{ $email->qrcode->qr_code_value ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.email.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Email::STATUS_SELECT[$email->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.email.fields.bootcamp_participant_email') }}
                        </th>
                        <td>
                            {{ $email->bootcamp_participant_email->email ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.emails.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection