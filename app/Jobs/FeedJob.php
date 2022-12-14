<?php

namespace App\Jobs;

use App\Enums\FoodCatalog;
use App\Exceptions\DangerousFoodException;
use App\Models\Dog;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

/**
 * A task which is done for all the dogs in the kennel.
 * https://laravel.com/docs/9.x/queues#defining-batchable-jobs
 */
class FeedJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Batchable;

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
        if ($this->batch()->cancelled()) {
            // Determine if the batch has been cancelled...
            return;
        }

        /**
         * Check any exceptions early
         */
        throw_if($this->dog->favorite_food === FoodCatalog::CHOCOLATE, new DangerousFoodException('You can not give '.$this->dog->name.' ' .$this->dog->favorite_food));

        if ($this->dog->favorite_food === FoodCatalog::LASAGNA) {
            Log::info($this->dog->name.': Grumble grumble a cat ate it...');
            $this->dog->weight = 999; // Arbitrary weight transition
            $this->dog->save();
            return;
        }

        Log::info($this->dog->name.': Yummy, my favorite, '.$this->dog->favorite_food);
    }
}
