<?php

namespace App\Jobs;

use App\Exceptions\LowWeightException;
use App\Models\Dog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

/**
 * A health inspection task which is chained with other health related tasks.
 */
class CheckWeightJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public Dog $dog)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        sleep(1);
        throw_if($this->dog->weight < 1000, new LowWeightException($this->dog->name. ' weighs only '.$this->dog->weight.' grams'));
        Log::info($this->dog->name.' is at healthy '.$this->dog->weight.' grams');
    }
}
