<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Mail\WelcomeEmail;


class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:welcome';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Welcome email to new user.';

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
    public function handle(WelcomeEmail $welcomeemail)
    {
         Mail::to('sadar.hashmi@abtach.org')->send($welcomeemail);
    }
}
