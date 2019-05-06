@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.tasks.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.tasks.fields.name')</th>
                            <td field-key='name'>{{ $task->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.tasks.fields.description')</th>
                            <td field-key='description'>{{ $task->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.tasks.fields.from')</th>
                            <td field-key='from'>{{ $task->from->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.tasks.fields.to')</th>
                            <td field-key='to'>
                                @foreach ($task->to as $singleTo)
                                    <span class="label label-info label-many">{{ $singleTo->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.tasks.fields.deadline')</th>
                            <td field-key='deadline'>{{ $task->deadline }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.tasks.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
@stop
