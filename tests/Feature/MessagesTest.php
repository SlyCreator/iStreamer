<?php


namespace Tests\Feature;

use App\Models\Message;
use App\Models\Series;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MessagesTest extends TestCase
{
    use DatabaseMigrations;

    public function testGetAllMessagesCollection()
    {
        $series = factory(Series::class,3)->create();
        $message = factory(Message::class,3)->create();

        $this->getJson("/api/v1/admin/Message",[
            'accept'    => 'application/vnd.api+json',
            'content-type' => 'application/vdn.api+json',
        ])
            ->assertStatus(200)
            ->assertJson([
                "data" => [
                    [
                        "id" => '1',
                        "type" => 'messages',
                        "attributes" => [
                            'title' => $message[0]->title,
                            'description' => $message[0]->description,
                            'series_id' => $message[0]->series_id,
                            'created_at' => $message[0]->created_at->toJson(),
                            'updated_at' => $message[0]->updated_at->toJson(),
                        ]
                    ],
                    [
                        "id" => '2',
                        "type" => 'messages',
                        "attributes" => [
                            'title' => $message[1]->title,
                            'description' => $message[1]->description,
                            'series_id' => $message[1]->series_id,
                            'created_at' => $message[1]->created_at->toJson(),
                            'updated_at' => $message[1]->updated_at->toJson(),
                        ]
                    ],
                    [
                        "id" => '3',
                        "type" => 'messages',
                        "attributes" => [
                            'title' => $message[2]->title,
                            'description' => $message[2]->description,
                            'series_id' => $message[2]->series_id,
                            'created_at' => $message[2]->created_at->toJson(),
                            'updated_at' => $message[2]->updated_at->toJson(),
                        ]
                    ]
                ]
            ]);
    }

    public function testGetAMessage()
    {

    }

    public function testCreateMessage()
    {

    }

    public function testUpdateMessage()
    {

    }

    public function testDeleteMessage()
    {

    }
}
