<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\alternatif;
use App\Models\criteria;

class HomeController extends Controller
{
    public function index(){

        $latestAlternatif = Alternatif::orderBy('id', 'desc')->first();
        $latestCriteria = Criteria::orderBy('id', 'desc')->first();

        return view('dashboard.home', compact('latestAlternatif','latestCriteria'));
    }
}
