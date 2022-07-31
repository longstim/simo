<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
Use Redirect;
use Auth;

class IndexController extends Controller
{
    public function index()
    {
        return view('homepage');
    }
}
