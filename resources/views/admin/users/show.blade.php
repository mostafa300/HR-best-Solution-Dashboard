@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.users.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.users.fields.name')</th>
                            <td field-key='name'>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.position')</th>
                            <td field-key='position'>{{ $user->position }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.email')</th>
                            <td field-key='email'>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.phone')</th>
                            <td field-key='phone'>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.id-number')</th>
                            <td field-key='id_number'>{{ $user->id_number }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.salary')</th>
                            <td field-key='salary'>{{ $user->salary }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.role')</th>
                            <td field-key='role'>{{ $user->role->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.department')</th>
                            <td field-key='department'>{{ $user->department->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.mac-adress')</th>
                            <td field-key='mac_adress'>{{ $user->mac_adress }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#transactions" aria-controls="transactions" role="tab" data-toggle="tab">Transactions</a></li>
<li role="presentation" class=""><a href="#transactions" aria-controls="transactions" role="tab" data-toggle="tab">Transactions</a></li>
<li role="presentation" class=""><a href="#tasks" aria-controls="tasks" role="tab" data-toggle="tab">Tasks</a></li>
<li role="presentation" class=""><a href="#tasks" aria-controls="tasks" role="tab" data-toggle="tab">Tasks</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="transactions">
<table class="table table-bordered table-striped {{ count($transactions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
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
<div role="tabpanel" class="tab-pane " id="transactions">
<table class="table table-bordered table-striped {{ count($transactions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
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
<div role="tabpanel" class="tab-pane " id="tasks">
<table class="table table-bordered table-striped {{ count($tasks) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.tasks.fields.name')</th>
                        <th>@lang('quickadmin.tasks.fields.description')</th>
                        <th>@lang('quickadmin.tasks.fields.from')</th>
                        <th>@lang('quickadmin.tasks.fields.to')</th>
                        <th>@lang('quickadmin.tasks.fields.deadline')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($tasks) > 0)
            @foreach ($tasks as $task)
                <tr data-entry-id="{{ $task->id }}">
                    <td field-key='name'>{{ $task->name }}</td>
                                <td field-key='description'>{{ $task->description }}</td>
                                <td field-key='from'>{{ $task->from->name or '' }}</td>
                                <td field-key='to'>
                                    @foreach ($task->to as $singleTo)
                                        <span class="label label-info label-many">{{ $singleTo->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='deadline'>{{ $task->deadline }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('task_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.tasks.restore', $task->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('task_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.tasks.perma_del', $task->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('task_view')
                                    <a href="{{ route('admin.tasks.show',[$task->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('task_edit')
                                    <a href="{{ route('admin.tasks.edit',[$task->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('task_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.tasks.destroy', $task->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="tasks">
<table class="table table-bordered table-striped {{ count($tasks) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.tasks.fields.name')</th>
                        <th>@lang('quickadmin.tasks.fields.description')</th>
                        <th>@lang('quickadmin.tasks.fields.from')</th>
                        <th>@lang('quickadmin.tasks.fields.to')</th>
                        <th>@lang('quickadmin.tasks.fields.deadline')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($tasks) > 0)
            @foreach ($tasks as $task)
                <tr data-entry-id="{{ $task->id }}">
                    <td field-key='name'>{{ $task->name }}</td>
                                <td field-key='description'>{{ $task->description }}</td>
                                <td field-key='from'>{{ $task->from->name or '' }}</td>
                                <td field-key='to'>
                                    @foreach ($task->to as $singleTo)
                                        <span class="label label-info label-many">{{ $singleTo->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='deadline'>{{ $task->deadline }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('task_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.tasks.restore', $task->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('task_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.tasks.perma_del', $task->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('task_view')
                                    <a href="{{ route('admin.tasks.show',[$task->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('task_edit')
                                    <a href="{{ route('admin.tasks.edit',[$task->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('task_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.tasks.destroy', $task->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


