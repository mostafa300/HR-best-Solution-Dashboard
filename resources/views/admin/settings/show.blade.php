@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.settings.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.settings.fields.compant-name')</th>
                            <td field-key='compant_name'>{{ $setting->compant_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.settings.fields.website')</th>
                            <td field-key='website'>{{ $setting->website }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.settings.fields.address')</th>
                            <td field-key='address'>{{ $setting->address }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.settings.fields.logo')</th>
                            <td field-key='logo'>@if($setting->logo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $setting->logo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $setting->logo) }}"/></a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.settings.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


