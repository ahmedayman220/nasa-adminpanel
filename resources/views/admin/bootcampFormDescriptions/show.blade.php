@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bootcampFormDescription.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bootcamp-form-descriptions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampFormDescription.fields.id') }}
                        </th>
                        <td>
                            {{ $bootcampFormDescription->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampFormDescription.fields.section_1_title') }}
                        </th>
                        <td>
                            {{ $bootcampFormDescription->section_1_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampFormDescription.fields.section_1_description') }}
                        </th>
                        <td>
                            {!! $bootcampFormDescription->section_1_description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampFormDescription.fields.national_id_front_description') }}
                        </th>
                        <td>
                            {{ $bootcampFormDescription->national_id_front_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampFormDescription.fields.national_id_back_description') }}
                        </th>
                        <td>
                            {{ $bootcampFormDescription->national_id_back_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampFormDescription.fields.section_2_title') }}
                        </th>
                        <td>
                            {{ $bootcampFormDescription->section_2_title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bootcamp-form-descriptions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection