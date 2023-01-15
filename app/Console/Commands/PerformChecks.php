<?php

namespace App\Console\Commands;

use App\Models\Endpoint;
use Illuminate\Console\Command;

class PerformChecks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checks:perform';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perform endpoint checks';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        Endpoint::query()
            ->where('next_check', '<=', now())
            ->each(function (Endpoint $endpoint) {
                // job
            });

        return Command::SUCCESS;
    }
}
