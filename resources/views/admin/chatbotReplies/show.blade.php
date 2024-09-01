@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.chatbotReply.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.chatbot-replies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.chatbotReply.fields.id') }}
                        </th>
                        <td>
                            {{ $chatbotReply->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.chatbotReply.fields.question') }}
                        </th>
                        <td>
                            {{ $chatbotReply->question }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.chatbotReply.fields.answer') }}
                        </th>
                        <td>
                            {!! $chatbotReply->answer !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.chatbotReply.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\ChatbotReply::STATUS_SELECT[$chatbotReply->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.chatbot-replies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection