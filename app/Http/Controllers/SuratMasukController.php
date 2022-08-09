<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Zend\Debug\Debug;

class SuratMasukController extends Controller
{
    public function index() 
    {

        // Debug::dump(auth()->user()->name);die();
        return view('surat-masuk.index');
    }
}
