<?php

namespace App\Http\Controllers\Web\Admin;

use App\DataTables\Admin\DelegationDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\AdminRequest;
use App\Models\Admin;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mpdf\Tag\Del;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DelegationController extends Controller
{
    use ImageTrait;

    public function __construct()
    {

    }

    public function index(DelegationDataTable $dataTable)
    {
        return $dataTable->render('dashboard.admin.delegation.index');
    }

    public function show()
    {
        $permissions = Permission::all();
        return view('dashboard.admin.delegation.show');
    }


}
