@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.transactions.title')</h3>
    @can('transaction_create')
    <p>
        <a href="{{ route('admin.transactions.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('transaction_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.transactions.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.transactions.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($transactions) > 0 ? 'datatable' : '' }} @can('transaction_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('transaction_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('quickadmin.transactions.fields.name')</th>
                        <th>@lang('quickadmin.transactions.fields.time-date')</th>
                        <th>@lang('quickadmin.transactions.fields.id-number')</th>
                        <th>@lang('quickadmin.transactions.fields.mac-adress')</th>
                        <th>@lang('quickadmin.transactions.fields.location')</th>
                        <th>@lang('quickadmin.transactions.fields.type')</th>
                        <th>@lang('quickadmin.transactions.fields.photo')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($transactions) > 0)
                        @foreach ($transactions as $transaction)
                            <tr data-entry-id="{{ $transaction->id }}">
                                @can('transaction_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='name'>{{ $transaction->name->name or '' }}</td>
                                <td field-key='time_date'>{{ $transaction->time_date }}</td>
                                <td field-key='id_number'>{{ $transaction->id_number->id_number or '' }}</td>
                                <td field-key='mac_adress'>{{ $transaction->mac_adress }}</td>
                                <td field-key='location'>{{ $transaction->location }}</td>
                                <td field-key='type'>{{ $transaction->type }}</td>
                                <td field-key='photo'>@if($transaction->photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $transaction->photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $transaction->photo) }}"/></a>@endif</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('transaction_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.transactions.restore', $transaction->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('transaction_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.transactions.perma_del', $transaction->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('transaction_view')
                                    <a href="{{ route('admin.transactions.show',[$transaction->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('transaction_edit')
                                    <a href="{{ route('admin.transactions.edit',[$transaction->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('transaction_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.transactions.destroy', $transaction->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="12">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('transaction_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.transactions.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection