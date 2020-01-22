<?php

namespace App\Http\Controllers;

use App\Imports\LocationImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    //
    public function store()
    {
        Excel::import(new LocationImport(), 'file.xls');
    }
}
