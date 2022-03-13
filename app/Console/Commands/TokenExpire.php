<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Laravel\Sanctum\PersonalAccessToken;

class TokenExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire User Access token after 15 days.';

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
        PersonalAccessToken::where( 'created_at', '<', Carbon::now()->subDays(30))->delete();
        return $this->info('Expired tokens removed successfully !');
    }
}
