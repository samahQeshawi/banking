<?php

namespace App\Http\Controllers\Web\Admin;

use App\DataTables\Admin\RolesDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:roles display', ['only' => ['index']]);
        // $this->middleware('permission:roles create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:roles update', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:roles delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2(RolesDataTable $dataTable)
    {
        $roles = Role::orderBy('id', 'DESC')->get();

        return $dataTable->render('dashboard.admin.roles.index', compact('roles'));
    }

    public function index()
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('dashboard.admin.roles.index2', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::where('guard_name', 'admin')->get();
        $excludedModules = ['subscriptions', 'restaurant_subscriptions'];
        $permissions = [];
        foreach ($permission as $item) {
            $per = explode(' ', $item->name);
            if (count($per) === 2 && ! in_array($per[0], $excludedModules)) {
                $permissions[$per[0]][$per[1]] = $item->id;
            }
        }

        return view('dashboard.admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $role = Role::create(['name' => $request->input('name')]);
            $permissions = Permission::whereIn('id', $request->input('permissions'))->get();
            $role->syncPermissions($permissions);
            DB::commit();

            return redirect()->route('admin.roles.index')
                ->with('success', 'تم إضافة الدور بنجاح!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating role', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء إضافة الدور. الرجاء المحاولة مرة أخرى.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $role = Role::find($id);
        $permissions = $this->groupedPermissions();
        $selectedPermissions = $role->permissions->pluck('id')->toArray();

        return view('dashboard.admin.roles.show', compact('role', 'permissions', 'selectedPermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $out = Role::find($id);

        $permission = Permission::where('guard_name', 'admin')->get();
        $excludedModules = ['subscriptions', 'restaurant_subscriptions'];
        $permissions = [];
        foreach ($permission as $item) {
            $per = explode(' ', $item->name);
            if (count($per) === 2 && ! in_array($per[0], $excludedModules)) {
                $permissions[$per[0]][$per[1]] = $item->id;
            }
        }

        return view('dashboard.admin.roles.edit', compact('out', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|unique:roles,name,'.$role->id,
            'permissions' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $role->update([
                'name' => $request->input('name'),
            ]);

            $permissions = Permission::whereIn('id', $request->input('permissions'))->get();
            $role->syncPermissions($permissions);
            DB::commit();

            return redirect()->route('admin.roles.index')
                ->with('success', 'تم تعديل الدور بنجاح!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error update role', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء تعديل الدور. الرجاء المحاولة مرة أخرى.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json('success');
    }

    public function groupedPermissions()
    {
        return Permission::select('name', 'id')
            ->get()
            ->groupBy(function ($item) {
                $group = explode(' ', $item->name);

                return count($group) > 2 ? $group[2] : $group[1];
            })
            ->map(fn ($items, $key) => [
                'name' => $key,
                'actions' => $items->pluck('name')->map(fn ($row) => explode(' ', $row)[0])->toArray(),
                'permissions' => $items->pluck('id')->toArray(),
            ])
            ->values();
    }
}
