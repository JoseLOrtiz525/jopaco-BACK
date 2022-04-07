<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function index()
    {
        return Excel::download(new UsersExport, 'user-list.xlsx');
        ['Success', 'Archivo Creado Exitosamente'];
    }
}
