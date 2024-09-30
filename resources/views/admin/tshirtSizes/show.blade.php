@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tshirtSize.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tshirt-sizes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tshirtSize.fields.id') }}
                        </th>
                        <td>
                            {{ $tshirtSize->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tshirtSize.fields.title') }}
                        </th>
                        <td>
                            {{ $tshirtSize->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tshirtSize.fields.extra_field') }}
                        </th>
                        <td>
                            {{ $tshirtSize->extra_field }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tshirtSize.fields.description') }}
                        </th>
                        <td>
                            {{ $tshirtSize->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tshirt-sizes.index') }}">
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
            <a class="nav-link" href="#tshirt_size_members" role="tab" data-toggle="tab">
                {{ trans('cruds.member.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tshirt_size_accepted_members" role="tab" data-toggle="tab">
                Accepted Onsite Members
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="tshirt_size_members">
            @includeIf('admin.tshirtSizes.relationships.tshirtSizeMembers', ['members' => $tshirtSize->tshirtSizeMembers])
        </div>
        <div class="tab-pane" role="tabpanel" id="tshirt_size_accepted_members">
            @includeIf('admin.tshirtSizes.relationships.tshirtSizeAcceptedOnsiteMembers', ['members' => $tshirtSize->tshirtSizeMembers])
        </div>
    </div>
</div>

@endsection
