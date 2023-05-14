<?php

namespace Tests\Feature;

use App\Models\Dog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class DogListingTest extends TestCase
{
    use RefreshDatabase;

    public function testListingDogs(): void
    {
        $dogs = Dog::factory()->count(50)->create();
        $response = $this->get('api/dogs');
        $response->assertOk();
        foreach ($dogs->slice(0, 30) as $key => $dog) {
            $response
                ->assertJson(fn(AssertableJson $json) => $json->has(30)
                    ->has($key, fn(AssertableJson $json) => $json->where('id', $dog->id)
                        ->where('name', $dog->name)
                        ->where('data', $dog->data)
                        ->has('created_at')
                        ->has('updated_at')
                    ));
        }
    }

    public function testListingDogsFilteredByName(): void
    {
        // create 25 dogs with random names and 25 dogs with the name 'Doggo' in order to test filtering by name
        Dog::factory()->count(25)->create();
        $customNameDogs = Dog::factory()->count(25)->customName('Doggo')->create();
        $response = $this->get('api/dogs?name=Doggo');
        $response->assertOk();
        foreach ($customNameDogs as $key => $dog) {
            $response
                ->assertJson(fn(AssertableJson $json) => $json->has(25)
                    ->has($key, fn(AssertableJson $json) => $json->where('id', $dog->id)
                        ->where('name', $dog->name)
                        ->where('data', $dog->data)
                        ->has('created_at')
                        ->has('updated_at')
                    ));
        }
    }
}
