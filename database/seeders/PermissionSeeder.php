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

            ['name' => 'home display', 'icon' => 'fas fa-home text-primary'],

            ['name' => 'accounts transfer', 'icon' => 'fas fa-exchange-alt text-success'],
            ['name' => 'accounts documents', 'icon' => 'fas fa-file-alt text-secondary'],
            ['name' => 'accounts interest_account', 'icon' => 'fas fa-percent text-danger'],
            ['name' => 'accounts smart_savings', 'icon' => 'fas fa-piggy-bank text-primary'],
            ['name' => 'accounts automatic_transfer', 'icon' => 'fas fa-sync-alt text-warning'],
            ['name' => 'accounts open_banking', 'icon' => 'fas fa-university text-info'],
            ['name' => 'accounts future_account', 'icon' => 'fas fa-calendar-alt text-dark'],

            ['name' => 'cards smart_savings', 'icon' => 'fas fa-piggy-bank text-primary'],
            ['name' => 'cards follow_up_requests', 'icon' => 'fas fa-list-alt text-secondary'],
            ['name' => 'cards tasaheel', 'icon' => 'fas fa-hand-holding-usd text-success'],
            ['name' => 'cards control', 'icon' => 'fas fa-cogs text-info'],
            ['name' => 'cards automatic_payment', 'icon' => 'fas fa-money-check-alt text-success'],
            ['name' => 'cards statement', 'icon' => 'fas fa-file-invoice text-warning'],
            ['name' => 'cards change_affiliation_limit', 'icon' => 'fas fa-edit text-danger'],
            ['name' => 'cards domestic_workers', 'icon' => 'fas fa-users text-primary'],

            ['name' => 'payments invoices', 'icon' => 'fas fa-file-invoice-dollar text-warning'],
            ['name' => 'payments government_payments', 'icon' => 'fas fa-building text-info'],
            ['name' => 'payments receipt_payments', 'icon' => 'fas fa-receipt text-secondary'],
            ['name' => 'payments invoice_operations', 'icon' => 'fas fa-tools text-success'],
            ['name' => 'payments invoice_payment', 'icon' => 'fas fa-money-bill-wave text-primary'],
            ['name' => 'payments split_invoices', 'icon' => 'fas fa-file-invoice text-danger'],
            ['name' => 'payments telecom_companies', 'icon' => 'fas fa-wifi text-info'],
            ['name' => 'payments scheduled_invoices', 'icon' => 'fas fa-calendar-alt text-secondary'],


            ['name' => 'investments return_account', 'icon' => 'fas fa-money-bill-wave text-success'],
            ['name' => 'investments future_account', 'icon' => 'fas fa-calendar-alt text-primary'],

            ['name' => 'admins display', 'icon' => 'fas fa-eye text-info'],
            ['name' => 'admins create', 'icon' => 'fas fa-plus text-success'],
            ['name' => 'admins update', 'icon' => 'fas fa-edit text-warning'],
            ['name' => 'admins delete', 'icon' => 'fas fa-trash text-danger'],

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
