<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Admin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::create([
            'name'              => 'Admin',
            'phone'             => '0170000000',
            'email'             => 'admin@gmail.com',
            'password'          => Hash::make('12345'),
            'role'              => 1,
            'status'            => 1,
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10),
        ]);
    }
}
