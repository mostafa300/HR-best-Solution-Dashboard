<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTransactionsRequest;
use App\Http\Requests\Admin\UpdateTransactionsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class TransactionsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('transaction_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('transaction_delete')) {
                return abort(401);
            }
            $transactions = Transaction::onlyTrashed()->get();
        } else {
            $transactions = Transaction::all();
        }

        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating new Transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('transaction_create')) {
            return abort(401);
        }
        
        $names = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $id_numbers = \App\User::get()->pluck('id_number', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.transactions.create', compact('names', 'id_numbers'));
    }

    /**
     * Store a newly created Transaction in storage.
     *
     * @param  \App\Http\Requests\StoreTransactionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionsRequest $request)
    {
        if (! Gate::allows('transaction_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $transaction = Transaction::create($request->all());



        return redirect()->route('admin.transactions.index');
    }


    /**
     * Show the form for editing Transaction.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('transaction_edit')) {
            return abort(401);
        }
        
        $names = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $id_numbers = \App\User::get()->pluck('id_number', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $transaction = Transaction::findOrFail($id);

        return view('admin.transactions.edit', compact('transaction', 'names', 'id_numbers'));
    }

    /**
     * Update Transaction in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionsRequest $request, $id)
    {
        if (! Gate::allows('transaction_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());



        return redirect()->route('admin.transactions.index');
    }


    /**
     * Display Transaction.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('transaction_view')) {
            return abort(401);
        }
        $transaction = Transaction::findOrFail($id);

        return view('admin.transactions.show', compact('transaction'));
    }


    /**
     * Remove Transaction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('transaction_delete')) {
            return abort(401);
        }
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('admin.transactions.index');
    }

    /**
     * Delete all selected Transaction at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('transaction_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Transaction::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Transaction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('transaction_delete')) {
            return abort(401);
        }
        $transaction = Transaction::onlyTrashed()->findOrFail($id);
        $transaction->restore();

        return redirect()->route('admin.transactions.index');
    }

    /**
     * Permanently delete Transaction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('transaction_delete')) {
            return abort(401);
        }
        $transaction = Transaction::onlyTrashed()->findOrFail($id);
        $transaction->forceDelete();

        return redirect()->route('admin.transactions.index');
    }
}
