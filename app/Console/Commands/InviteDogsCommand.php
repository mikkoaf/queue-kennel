<?php

namespace App\Console\Commands;

use App\Models\Dog;
use Illuminate\Console\Command;

class InviteDogsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dogs:invite {dogs : Number of dogs invited}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate kennel database with amount of dogs';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = $this->argument('dogs');
        $this->info('Inviting '.$count. ' new dogs');

        Dog::factory()->count($count)->create();

        $this->info('Currently '.Dog::query()->count().' dogs as occupants.');
        return Command::SUCCESS;
    }
}
