<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InputDokumen;
use App\Models\Shelf;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $count_shelf = Shelf::count();
        $count_dokumen = InputDokumen::count();

        return view('admin.dashboard.index', compact('count_shelf', 'count_dokumen'));
    }
}
