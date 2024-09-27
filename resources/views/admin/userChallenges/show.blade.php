@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.userChallenge.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.user-challenges.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userChallenge.fields.id') }}
                        </th>
                        <td>
                            {{ $userChallenge->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userChallenge.fields.user') }}
                        </th>
                        <td>
                            @foreach($userChallenge->users as $key => $user)
                                <span class="label label-info">{{ $user->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userChallenge.fields.challenge') }}
                        </th>
                        <td>
                            @foreach($userChallenge->challenges as $key => $challenge)
                                <span class="label label-info">{{ $challenge->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.user-challenges.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
