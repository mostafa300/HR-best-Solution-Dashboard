@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.transactions.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.transactions.fields.name')</th>
                            <td field-key='name'>{{ $transaction->name->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.transactions.fields.time-date')</th>
                            <td field-key='time_date'>{{ $transaction->time_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.transactions.fields.id-number')</th>
                            <td field-key='id_number'>{{ $transaction->id_number->id_number or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.transactions.fields.mac-adress')</th>
                            <td field-key='mac_adress'>{{ $transaction->mac_adress }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.transactions.fields.location')</th>
                            <td field-key='location'>{{ $transaction->location }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.transactions.fields.type')</th>
                            <td field-key='type'>{{ $transaction->type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.transactions.fields.photo')</th>
                            <td field-key='photo'>@if($transaction->photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $transaction->photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $transaction->photo) }}"/></a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.transactions.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
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
            
            $('.datetime').datetimepicker({
                format: "{{ config('app.datetime_format_moment') }}",
                locale: "{{ App::getLocale() }}",
                sideBySide: true,
            });
            
        });
    </script>
            
@stop
