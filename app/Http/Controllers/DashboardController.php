<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $user = 'Abdallah Ahmed';
         return view('admin.index' ,get_defined_vars()) ;
    }


}
