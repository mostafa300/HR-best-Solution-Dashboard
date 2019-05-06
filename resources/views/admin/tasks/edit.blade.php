@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.tasks.title')</h3>
    
    {!! Form::model($task, ['method' => 'PUT', 'route' => ['admin.tasks.update', $task->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('quickadmin.tasks.fields.name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('quickadmin.tasks.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('from_id', trans('quickadmin.tasks.fields.from').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('from_id', $froms, old('from_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('from_id'))
                        <p class="help-block">
                            {{ $errors->first('from_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('to', trans('quickadmin.tasks.fields.to').'*', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-to">
                        {{ trans('quickadmin.qa_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-to">
                        {{ trans('quickadmin.qa_deselect_all') }}
                    </button>
                    {!! Form::select('to[]', $tos, old('to') ? old('to') : $task->to->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-to' , 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('to'))
                        <p class="help-block">
                            {{ $errors->first('to') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('deadline', trans('quickadmin.tasks.fields.deadline').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('deadline', old('deadline'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('deadline'))
                        <p class="help-block">
                            {{ $errors->first('deadline') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
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
            
    <script>
        $("#selectbtn-to").click(function(){
            $("#selectall-to > option").prop("selected","selected");
            $("#selectall-to").trigger("change");
        });
        $("#deselectbtn-to").click(function(){
            $("#selectall-to > option").prop("selected","");
            $("#selectall-to").trigger("change");
        });
    </script>
@stop