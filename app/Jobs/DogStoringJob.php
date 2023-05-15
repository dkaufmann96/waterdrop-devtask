<?php

namespace App\Jobs;

use App\Models\Dog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DogStoringJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $dogData;

    public function __construct(array $dogData)
    {
        $this->dogData = $dogData;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        sleep(10);
        $dog = new Dog($this->dogData);
        $dog->save();
    }
}
