<?php

namespace App\Console\Commands;

use App\Models\Membership;
use Illuminate\Console\Command;

class ExpireMemberships extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'memberships:expire';

    /**
     * The console command description.
     */
    protected $description = 'Mark expired memberships as inactive';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredCount = Membership::where('status', 'active')
            ->where('end_date', '<=', now())
            ->update(['status' => 'expired']);

        $this->info("✅ {$expiredCount} memberships have been marked as expired.");

        return 0;
    }
}