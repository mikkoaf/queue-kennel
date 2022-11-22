<?php

namespace App\Console\Commands;

use App\Jobs\CallDoctorJob;
use App\Jobs\CheckTeethJob;
use App\Jobs\CheckWeightJob;
use App\Models\Dog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Throwable;

class HealthInspectionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dogs:check-up {dog : ID of the dog to check up on}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dog = Dog::find($this->argument('dog'));
        Bus::chain([
            new CheckTeethJob($dog),
            new CheckWeightJob($dog),
        ])->catch(function (Throwable $e) use ($dog) {
            CallDoctorJob::dispatch($dog);
        })->dispatch();
        return Command::SUCCESS;
    }
}
