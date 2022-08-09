<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Zend\Debug\Debug;

class SuratKeluarController extends Controller
{
    public function index() 
    {

        // Debug::dump(auth()->user()->name);die();
        return view('surat-keluar.index');
    }
}
