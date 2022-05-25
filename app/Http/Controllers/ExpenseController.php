<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::where('user_id', auth()->user()->id)->get();
        return view('users.expenses.index', compact(['expenses']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseRequest $request)
    {
        $input = $request->all();
        if($file = $request->file('receipt'))
        {
            $file_name=time().$file->getClientOriginalName();
            $file->move('assets/receipt', $file_name );
           $input['receipt']= $file_name;
        }   
        $input['user_id']= auth()->user()->id;
        $input['status']= 'New';

        Expense::create($input);
        return redirect(route('expenses.index'))->with('success', 'New expenses added successfully');     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        if($file = $request->file('receipt'))
        {
            $file_name=time().$file->getClientOriginalName();
            $file->move('assets/receipt', $file_name );
           $input['receipt']= $file_name;
        }   
        $input['user_id']= auth()->user()->id;
        $input['status']= 'New';

        Expense::findOrfail($id)->update($input);
        return redirect(route('expenses.index'))->with('success', 'Expenses updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expenses = Expense::findOrfail($id);

        if (empty($expenses)) {            
            return redirect(route('expenses.index'))->with('error', 'Expenses not found');
        }
        $expenses->forceDelete();    
        return redirect(route('expenses.index'))->with('success', 'Expenses deleted successfully');
    }
     
}
