<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            //internal donated item စတို စာရင်း
            ['name' => 'create-internal-donated-items'],
            ['name' => 'create-and-confirm-internal-donated-items'],
            ['name' => 'read-internal-donated-items'],
            ['name' => 'update-internal-donated-items'],
            ['name' => 'delete-internal-donated-items'],
            //share internal donated item
            ['name' => 'create-share-internal-donated-item'],
            ['name' => 'read-share-internal-donated-item'],
            ['name' => 'update-share-internal-donated-item'],
            ['name' => 'delete-share-internal-donated-item'],
            //team
            ['name' => 'create-team'],
            ['name' => 'read-team'],
            ['name' => 'edit-team'],
            ['name' => 'delete-team'],
            ['name' => 'restore-team'],
            //yogi
            ['name' => 'create-yogi'],
            ['name' => 'read-yogi'],
            ['name' => 'edit-yogi'],
            ['name' => 'delete-yogi'],
            ['name' => 'restore-yogi'],
            //volunteer
            ['name' => 'create-volunteer'],
            ['name' => 'read-volunteer'],
            ['name' => 'edit-volunteer'],
            ['name' => 'delete-volunteer'],
            ['name' => 'restore-volunteer'],
            
            //admin
            ['name' => 'create-admin'],
            ['name' => 'read-admin'],
            ['name' => 'edit-admin'],
            ['name' => 'delete-admin'],
            ['name' => 'restore-admin'],
            //item type 
            ['name' => 'create-item-type'],
            ['name' => 'read-item-type'],
            ['name' => 'edit-item-type'],
            ['name' => 'delete-item-type'],
            ['name' => 'restore-item-type'],
            //item sub type 
            ['name' => 'create-item-sub-type'],
            ['name' => 'read-item-sub-type'],
            ['name' => 'edit-item-sub-type'],
            ['name' => 'delete-item-sub-type'],
            ['name' => 'restore-item-sub-type'],
            // country
            ['name' => 'create-country'],
            ['name' => 'read-country'],
            ['name' => 'edit-country'],
            ['name' => 'delete-country'],
            ['name' => 'restore-country'],
            // state region
            ['name' => 'create-state-region'],
            ['name' => 'read-state-region'],
            ['name' => 'edit-state-region'],
            ['name' => 'delete-state-region'],
            ['name' => 'restore-state-region'],
            // city
            ['name' => 'create-city'],
            ['name' => 'read-city'],
            ['name' => 'edit-city'],
            ['name' => 'delete-city'],
            ['name' => 'restore-city'],
            // unit
            ['name' => 'create-unit'],
            ['name' => 'read-unit'],
            ['name' => 'edit-unit'],
            ['name' => 'delete-unit'],
            ['name' => 'restore-unit'],
            // center
            ['name' => 'create-center'],
            ['name' => 'read-center'],
            ['name' => 'edit-center'],
            ['name' => 'delete-center'],
            ['name' => 'restore-center'],
            // ward
            ['name' => 'create-ward'],
            ['name' => 'read-ward'],
            ['name' => 'edit-ward'],
            ['name' => 'delete-ward'],
            ['name' => 'restore-ward'],
            // alms round
            ['name' => 'create-alms-round'],
            ['name' => 'read-alms-round'],
            ['name' => 'edit-alms-round'],
            ['name' => 'delete-alms-round'],
            ['name' => 'restore-alms-round'],
            // office
            ['name' => 'create-office'],
            ['name' => 'read-office'],
            ['name' => 'edit-office'],
            ['name' => 'delete-office'],
            ['name' => 'restore-office'],
            // role
            ['name' => 'create-role'],
            ['name' => 'read-role'],
            ['name' => 'edit-role'],
            ['name' => 'delete-role'],
        ];


        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission['name']]);
        }
    }
}
