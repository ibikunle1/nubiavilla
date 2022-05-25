<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Weader;
use App\Models\Expense;
use App\Models\Weather;
use Illuminate\Http\Request;
use App\Imports\ImportExpense;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        $user = User::where('id', auth()->user()->id)->first();
        return view('users.dashboard', compact(['user']));
    }   
    
    public function editprofile(UserRequest $request, $id)    
    {    
        $input= $request->all();

        if($file = $request->file('profile_picture'))
        {
            $file_name=time().$file->getClientOriginalName();
            $file->move('assets/picture', $file_name );
           $input['profile']= $file_name;
        }     
        User::findOrFail($id)->update($input);
        return redirect(route('home'))->with('success', 'Profile updated successfully');        
    }

    public function file_import(){
        return view('users.expenses.import');
    }
    public function import(Request $request){
        Excel::import(new ImportExpense, $request->file('file')->store('files'));

        return redirect(route('expenses.index'))->with('success', 'Import successful');               
    }


}
