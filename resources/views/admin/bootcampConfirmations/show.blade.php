@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.bootcampConfirmation.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.bootcamp-confirmations.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampConfirmation.fields.id') }}
                        </th>
                        <td>
                            {{ $bootcampConfirmation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampConfirmation.fields.name') }}
                        </th>
                        <td>
                            {{ $bootcampConfirmation->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampConfirmation.fields.email') }}
                        </th>
                        <td>
                            {{ $bootcampConfirmation->email->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampConfirmation.fields.national') }}
                        </th>
                        <td>
                            {{ $bootcampConfirmation->national->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampConfirmation.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $bootcampConfirmation->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampConfirmation.fields.slot') }}
                        </th>
                        <td>
                            {{ $bootcampConfirmation->slot->title ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.bootcamp-confirmations.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
