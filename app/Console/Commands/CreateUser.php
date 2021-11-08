<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user';

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
        $name = $this->ask("What is the users username?");
        $email = $this->ask("What is the users email?");
        $admin = $this->confirm("Is this user a super admin?");
        $pass = $this->secret("What is the users password?");

        User: $user = new User();

        $user->name = $name;
        $user->email = $email;
        $user->super = $admin;
        $user->password = Hash::make($pass);

        $user->save();
        return CommandAlias::SUCCESS;
    }
}
