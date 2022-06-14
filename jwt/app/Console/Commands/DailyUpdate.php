<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DailyUpdate extends Command implements ShouldQueue
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        // Log::info('Crom Done');
 
        $unapproved_users = User::join('roles', 'roles.id', 'users.role_id')
            ->where('roles.name', '!=', 'admin')
            ->where('users.is_approved', 0)
            ->select('users.name', 'users.email', 'roles.name as rolename')
            ->get();
        $admin = User::where('role_id', 1)->select('email')->first();
        $details = $unapproved_users;
        Mail::to($admin->email)->send(new \App\Mail\UnapprovedUsersMail($details));
    }
}
