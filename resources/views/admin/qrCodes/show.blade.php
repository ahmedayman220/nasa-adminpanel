@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.qrCode.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.qr-codes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.qrCode.fields.id') }}
                        </th>
                        <td>
                            {{ $qrCode->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.qrCode.fields.bootcamp_participant') }}
                        </th>
                        <td>
                            {{ $qrCode->bootcamp_participant->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.qrCode.fields.qr_code_value') }}
                        </th>
                        <td>
                            {{ $qrCode->qr_code_value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.qrCode.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\QrCode::STATUS_RADIO[$qrCode->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.qr-codes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#qrcode_emails" role="tab" data-toggle="tab">
                {{ trans('cruds.email.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="qrcode_emails">
            @includeIf('admin.qrCodes.relationships.qrcodeEmails', ['emails' => $qrCode->qrcodeEmails])
        </div>
    </div>
</div>

@endsection