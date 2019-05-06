<?php

namespace App\Http\Controllers\Admin;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTasksRequest;
use App\Http\Requests\Admin\UpdateTasksRequest;

class TasksController extends Controller
{
    /**
     * Display a listing of Task.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('task_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('task_delete')) {
                return abort(401);
            }
            $tasks = Task::onlyTrashed()->get();
        } else {
            $tasks = Task::all();
        }

        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating new Task.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('task_create')) {
            return abort(401);
        }
        
        $froms = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $tos = \App\User::get()->pluck('name', 'id');


        return view('admin.tasks.create', compact('froms', 'tos'));
    }

    /**
     * Store a newly created Task in storage.
     *
     * @param  \App\Http\Requests\StoreTasksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTasksRequest $request)
    {
        if (! Gate::allows('task_create')) {
            return abort(401);
        }
        $task = Task::create($request->all());
        $task->to()->sync(array_filter((array)$request->input('to')));



        return redirect()->route('admin.tasks.index');
    }


    /**
     * Show the form for editing Task.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('task_edit')) {
            return abort(401);
        }
        
        $froms = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $tos = \App\User::get()->pluck('name', 'id');


        $task = Task::findOrFail($id);

        return view('admin.tasks.edit', compact('task', 'froms', 'tos'));
    }

    /**
     * Update Task in storage.
     *
     * @param  \App\Http\Requests\UpdateTasksRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTasksRequest $request, $id)
    {
        if (! Gate::allows('task_edit')) {
            return abort(401);
        }
        $task = Task::findOrFail($id);
        $task->update($request->all());
        $task->to()->sync(array_filter((array)$request->input('to')));



        return redirect()->route('admin.tasks.index');
    }


    /**
     * Display Task.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('task_view')) {
            return abort(401);
        }
        $task = Task::findOrFail($id);

        return view('admin.tasks.show', compact('task'));
    }


    /**
     * Remove Task from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('task_delete')) {
            return abort(401);
        }
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('admin.tasks.index');
    }

    /**
     * Delete all selected Task at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('task_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Task::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Task from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('task_delete')) {
            return abort(401);
        }
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->restore();

        return redirect()->route('admin.tasks.index');
    }

    /**
     * Permanently delete Task from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('task_delete')) {
            return abort(401);
        }
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->forceDelete();

        return redirect()->route('admin.tasks.index');
    }
}
