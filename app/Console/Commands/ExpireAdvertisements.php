<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Advatisement;
use Carbon\Carbon;

class ExpireAdvertisements extends Command
{
    protected $signature = 'ads:expire';
    protected $description = 'Expire freelancer advertisements after one month';

    public function handle()
    {
        $count = Advatisement::where('status', 'open')
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', Carbon::now())
            ->update(['status' => 'expired']);

        $this->info("$count advertisements expired successfully.");
    }
}

