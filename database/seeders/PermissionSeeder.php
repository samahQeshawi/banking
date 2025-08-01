<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function permissions(): array
    {
        return [

            ['name' => 'home display', 'icon' => 'fas fa-home'],
            ['name' => 'accounts transfer', 'icon' => 'fas fa-exchange-alt'],
            ['name' => 'accounts documents', 'icon' => 'fas fa-file-alt'],
            ['name' => 'accounts interest_account', 'icon' => 'fas fa-percent'],
            ['name' => 'accounts smart_savings', 'icon' => 'fas fa-piggy-bank'],
            ['name' => 'accounts automatic_transfer', 'icon' => 'fas fa-sync-alt'],
            ['name' => 'accounts open_banking', 'icon' => 'fas fa-university'],
            ['name' => 'accounts future_account', 'icon' => 'fas fa-calendar-alt'],

            ['name' => 'cards smart_savings', 'icon' => 'fas fa-piggy-bank'],
            ['name' => 'cards follow_up_requests', 'icon' => 'fas fa-list-alt'],
            ['name' => 'cards tasaheel', 'icon' => 'fas fa-hand-holding-usd'],
            ['name' => 'cards control', 'icon' => 'fas fa-cogs'],
            ['name' => 'cards statement', 'icon' => 'fas fa-file-invoice'],
            ['name' => 'cards change_affiliation_limit', 'icon' => 'fas fa-edit'],
            ['name' => 'cards automatic_payment', 'icon' => 'fas fa-money-check-alt'],
            ['name' => 'cards domestic_workers', 'icon' => 'fas fa-users'],

            ['name' => 'payments invoices', 'icon' => 'fas fa-file-invoice-dollar'],
            ['name' => 'payments government_payments', 'icon' => 'fas fa-building'],
            ['name' => 'payments receipt_payments', 'icon' => 'fas fa-receipt'],
            ['name' => 'payments invoice_operations', 'icon' => 'fas fa-tools'],
            ['name' => 'payments invoice_payment', 'icon' => 'fas fa-money-bill-wave'],
            ['name' => 'payments split_invoices', 'icon' => 'fas fa-tools'],
            ['name' => 'payments telecom_companies', 'icon' => 'fas fa-wifi'],
            ['name' => 'payments scheduled_invoices', 'icon' => 'fas fa-calendar-alt'],

            ['name' => 'investments return_account', 'icon' => 'fas fa-money-bill-wave'],
            ['name' => 'investments future_account', 'icon' => 'fas fa-calendar-alt'],

            ['name' => 'admins display', 'icon' => 'fas fa-eye'],
            ['name' => 'admins create', 'icon' => 'fas fa-plus'],
            ['name' => 'admins update', 'icon' => 'fas fa-edit'],
            ['name' => 'admins delete', 'icon' => 'fas fa-trash'],

        ];

    }

    /**
     * Run the database seeds.
     * Refresh system permissions
     *
     * @return void
     */
    public function run()
    {
        Permission::query()->delete();
        $permissions = $this->permissions();

        $insertedPermissions = [];
        foreach ($permissions as $permission) {
            $insertedPermissions[] = [
                'name' => $permission['name'],
                'guard_name' => 'admin',
                'icon' => $permission['icon'],
            ];
        }
        Permission::insert($insertedPermissions);

        // Assign permissions to role

        $permissions = Permission::pluck('name')->toArray();

        $admin1 = Admin::find(1);
        $admin2 = Admin::find(2);

        $admin1->syncPermissions($permissions);
        $admin2->syncPermissions($permissions);

    }
}
