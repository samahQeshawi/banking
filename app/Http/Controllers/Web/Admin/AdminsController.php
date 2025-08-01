<?php

namespace App\Http\Controllers\Web\Admin;

use App\DataTables\Admin\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\AdminRequest;
use App\Models\Admin;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminsController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('permission:admins display', ['only' => ['index', 'show']]);
        $this->middleware('permission:admins create', ['only' => ['create', 'store']]);
        $this->middleware('permission:admins update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:admins delete', ['only' => ['destroy']]);
    }

    public function index(AdminDataTable $dataTable)
    {
        return $dataTable->render('dashboard.admin.admins.index');
    }


    public function create()
    {
        $roles = Role::get();
        $permission = Permission::where('guard_name', 'admin')->get();
        
        $permissions = [];
        foreach ($permission as $item) {
        $per = explode(' ', $item->name);
        if (count($per) === 2) {
            $permissions[$per[0]][$per[1]] = [
                'id' => $item->id,
                'icon' => $item->icon,
            ];
        }
    }
        return view('dashboard.admin.admins.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created Admin in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $data = $request->except(['permissions']);

        $delegate = Admin::where('phone', $request->phone)->first();

        DB::table('admin_delegate')->updateOrInsert([
            'admin_id' => auth('admin')->id(),
            'delegate_id' => $delegate->id,
        ], [
        'id_number' => $request->id_number,
        'problem' => $request->problem,
        'delegation_duration' => $request->delegation_duration,
        'agency_number' => $request->agency_number,
        'agency_type' => $request->agency_type,
        'max_amount' => $request->max_amount,
        'updated_at' => now(),
        'created_at' => now(),
        ]);

        $permissions = Permission::whereIn('id', $request->input('permissions'))->get();
        $delegate->syncPermissions($permissions);
     
        return redirect()->route('admin.admins.index')
            ->with('success', 'تم انشاء المشرف بنجاح.');
    }

    public function show($id)
    {
        $admin = Admin::findOrFail($id);

        return view('dashboard.admin.admins.show', compact('admin'));
    }

    public function edit($id)
    {

        $admin = Admin::findOrFail($id);
        $roles = Role::get();

        return view('dashboard.admin.admins.edit', compact('admin','roles'));
    }

    public function update(AdminRequest $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $data = $request->except(['image', 'role_id','password_confirmation']);
        $uploadFields = ['image'];

        $this->saveAttachments($admin, $uploadFields,'admins');

        if ($request->filled('role_id')) {
          $role = Role::find($request->role_id);
          if ($role) {
            $admin->syncRoles([$role->name]); // هذا يحذف الأدوار القديمة ويضيف الجديد فقط
          }
        }

        $admin->update($data);

        return redirect()->route('admin.admins.index')
            ->with('success', 'تم تعديل المشرف بنجاح.');
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        if ($admin->image) {
            $admin->deleteImg($admin->image);
        }
        $admin->delete();

        return response()->json(['success' => true]);
    }

    public function updateStatus($id)
    {
        try {
            $admin = Admin::findorFail($id);

            $admin->update(['status' => ! $admin->status]);

            return response()->json('success');

        } catch (\Exception $ex) {
            return response()->json(__('messages.There was an error try again'), 400);
        }
    }
}
