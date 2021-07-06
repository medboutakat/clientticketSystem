<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionBootstrap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel_api:bootstrap';

    public $defaultRoles = ["super-admin", "user-manager", "role-manager"];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create roles and permissions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->line('------------- Setting Up Roles:');

        $user = User::create([
            'email' => 'delivery123@gmail.com',
            'password' => 'delivery123',
            'username' => 'delivery123',
            'first_name' => 'Mohamed',
            'last_name' => 'Sabri',
            'display_name' => 'Mohamed',
            'activated_at' => '2020-11-22 17:14:49',
            'site_map'=>'[{"displayName":"New Command","iconName":"person","route":"/commands"},{"displayName":"Delivered Command","iconName":"person","route":"/delivered"},{"displayName":"Produit","iconName":"face","route":"/salary"},{"displayName":"Category","iconName":"person","route":"/salary-category"},{"displayName":"Fournisseur","iconName":"person","route":"/branch"},{"displayName":"User/Customer","iconName":"person","route":"/users"}]',
        ]);

        $user->markEmailAsVerified();

        foreach ($this->defaultRoles as $role) {
            $role = Role::updateOrCreate(['name' => $role, 'guard_name' => 'api']);
            $this->info("Created " . $role->name . " Role");
        }

        $this->line('------------- Setting Up Permissions:'); 
        $superAdminRole = Role::where('name', "super-admin")->first(); 
        $this->info("All permissions are granted to Super Admin");
        $this->line('------------- Application Bootstrapping is Complete: \n');

        $superAdminRole = Role::findByName('super-admin');
        $user->assignRole($superAdminRole);
    }
}
