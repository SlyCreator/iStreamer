<?php


namespace Tests\Feature;


use App\Models\Tag;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TagTest extends TestCase
{
    use DatabaseMigrations;

    public function testGetAllTags()
    {
        $tags   =   factory(Tag::class,3)->create();

        $this->getJson("",[
            'accept'    => 'application/vnd.api+json',
            'content-type' => 'application/vdn.api+json',
        ])
            ->assertStatus(200)
            ->assertJson([
                "data" =>[
                    [
                        "1" => '1',
                        "type" => 'tags',
                        "attributes" =>[

                        ]
                    ]
                ]
            ]);
    }

    public function testGetATag()
    {

    }

    public function testCreateTag()
    {

    }

    public function testUpdateTag()
    {

    }

    public function testDeleteTag()
    {

    }
}
