<?php

namespace App\Console\Commands;

use App\Jobs\FeedJob;
use App\Models\Dog;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Throwable;

class FeedDogsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dogs:feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This works an introduction to batching';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $jobs = Dog::query()->chunkMap(function (Dog $dog) {
            return new FeedJob($dog);
        });

        $batch = Bus::batch($jobs)->then(function (Batch $batch) {
            Log::info('The '.$batch->name.' jobs completed is now complete');
        })->catch(function (Batch $batch, Throwable $e) {
            Log::info($batch->name.' resulted in an exception '.$e->getMessage());
        })->finally(function (Batch $batch) {
            Log::info('The '.$batch->name.' batch has now ended');
        })->name('Chow time')
            ->dispatch();
        return Command::SUCCESS;
    }
}
