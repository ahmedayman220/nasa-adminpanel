@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.chatbotTraningData.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.chatbot-traning-datas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.chatbotTraningData.fields.id') }}
                        </th>
                        <td>
                            {{ $chatbotTraningData->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.chatbotTraningData.fields.question') }}
                        </th>
                        <td>
                            {{ $chatbotTraningData->question }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.chatbotTraningData.fields.answer') }}
                        </th>
                        <td>
                            {!! $chatbotTraningData->answer !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.chatbot-traning-datas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection