<?php

namespace Tests\Feature;

use App\Jobs\DogStoringJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;
use Tests\TestCase;

class DogStoringTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testStoringDog()
    {
        $data = [
            'name' => $this->faker->name,
            'data' => ['breed' => 'Golden Retriever', 'age' => 3]
        ];

        $response = $this->postJson('api/dogs', $data, ['Authorization' => config('app.secret')]);

        $response->assertStatus(200);
        Queue::assertPushed(DogStoringJob::class);
    }

    public function testStoringDogWithExactLimitLengthName()
    {
        $data = [
            'name' => Str::random(255),
            'data' => ['breed' => 'Golden Retriever', 'age' => 3]
        ];

        $response = $this->postJson('api/dogs', $data, ['Authorization' => config('app.secret')]);

        $response->assertStatus(200);
        Queue::assertPushed(DogStoringJob::class);
    }

    public function testStoringDogWithTooLongName()
    {
        $data = [
            'name' => Str::random(256),
            'data' => ['breed' => 'Golden Retriever', 'age' => 3]
        ];

        $response = $this->postJson('api/dogs', $data, ['Authorization' => config('app.secret')]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('name');
        Queue::assertNothingPushed();
    }

    public function testStoringDogWithInvalidData()
    {
        $data = [
            'name' => $this->faker->name,
            'data' => 'invalid'
        ];

        $response = $this->postJson('api/dogs', $data, ['Authorization' => config('app.secret')]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('data');
        Queue::assertNothingPushed();
    }

    public function testStoringDogUnauthorized() {
        $data = [
            'name' => Str::random(255),
            'data' => ['breed' => 'Golden Retriever', 'age' => 3]
        ];

        $response = $this->postJson('api/dogs', $data);

        $response->assertStatus(403);
        $response->assertExactJson(['error' => 'Unauthorized']);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Queue::fake();
    }
}
