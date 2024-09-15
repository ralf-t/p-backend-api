<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Record;
class RecordTest extends TestCase
{
    public function test_create_record(): void
    {
        $name = 'Test user';

        $data = [
            'name' => $name,
            'location' => 'Test location',
            'depth' => 20,
            'duration' => 50
        ];

        $response = $this->postJson('/api/records', $data);

        $response
        ->assertStatus(201)
        ->assertJsonStructure([
            'name',
            'location',
            'depth',
            'duration',
            'updated_at',
            'created_at',
            'id'
        ]);

        Record::where('name', '=', $name)->delete();
    }

    public function test_get_all(): void
    {
        $response = $this->getJson('/api/records');
        $response->assertStatus(200);
    }

    public function test_delete_record(): void {
        $name = 'Test user';

        $data = [
            'name' => $name,
            'location' => 'Test location',
            'depth' => 20,
            'duration' => 50
        ];

        $record = Record::create($data);

        $response = $this->deleteJson('/api/records/'.$record->id, $data);

        $response->assertStatus(200);

        Record::where('name', '=', $name)->delete();
    }
}
