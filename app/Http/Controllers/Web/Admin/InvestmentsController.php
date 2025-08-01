<?php

namespace App\Http\Controllers\Web\Admin;

use App\DataTables\Admin\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\AdminRequest;
use App\Models\Admin;
use App\Traits\ImageTrait;


class InvestmentsController extends Controller
{
    use ImageTrait;

    public function __construct()
    {

    }

    public function index()
    {
        return view('dashboard.admin.investments.index');
    }


}
