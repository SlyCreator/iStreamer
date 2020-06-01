<?php


namespace Tests\Feature;

use App\Models\Series;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SeriesTest extends TestCase
{
    use DatabaseMigrations;

    public function testGetAllSeriesAsCollection()
    {
        $series =   factory(Series::class,3)->create();

        $this->getJson("/api/v1/admin/series",[
            'accept'    => 'application/vnd.api+json',
            'content-type' => 'application/vdn.api+json',
        ])
          ->assertStatus(200)
          ->assertJson([
              "data" =>[
                  [
                      "id" => '1',
                      "type" => 'series',
                      "attributes" => [
                          'title' => $series[0]->title,
                          'description' => $series[0]->description ,
                          'year' =>  $series[0]->year,
                          'created_at' => $series[0]->created_at->toJSON(),
                          'updated_at' => $series[0]->updated_at->toJSoN(),
                      ]
                  ],
                  [
                      "id" => '2',
                      "type" => 'series',
                      "attributes" => [
                          'title' => $series[1]->title,
                          'description' => $series[1]->description ,
                          'year' =>  $series[1]->year,
                          'created_at' => $series[1]->created_at->toJSON(),
                          'updated_at' => $series[1]->updated_at->toJSoN(),
                      ]
                  ],
                  [
                      "id" => '3',
                      "type" => 'series',
                      "attributes" => [
                          'title' => $series[2]->title,
                          'description' => $series[2]->description ,
                          'year' =>  $series[2]->year,
                          'created_at' => $series[2]->created_at->toJSON(),
                          'updated_at' => $series[2]->updated_at->toJSoN(),
                      ]
                  ],

              ]
          ]);
    }

    public function testGetASeriesAsAResourceObject()
    {
        $series =   factory(Series::class)->create();
      $this->getJson("/api/v1/admin/series/1",[
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json',
            ])
                ->assertStatus(200)
                ->assertJson([
                "data" => [
                    "id" => '1',
                    "type" => 'series',
                    "attributes" => [
                        'title' => $series->title,
                        'description' => $series->description ,
                        'year' =>  $series->year,
                        'created_at' => $series->created_at->toJSON(),
                        'updated_at' => $series->updated_at->toJSoN(),
                    ]
                ]
        ]);

    }

    public function testCreateSeriesAsAResourceObject()
    {
 //       $faker = Factory::create();
//        $data   =    [
//            'type' => 'series',
//            "attributes" => [
//                'title' => $faker->text(20),
//                'description' => $faker->text(200),
//                'year' =>  $faker->year,
//
//            ]
//        ];

        $this->postJson('api/v1/admin/series',[
            'data' =>[
                'type' => 'series',
                "attributes" => [
                    'title' => 'Time with God',
                    'description' => 'A series of time with God',
                    'year' => '2020',
                ]
            ]
        ],[
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(201)
            ->assertJson([
                "data" => [
                    "id" => '1',
                    "type" => 'series',
                    "attributes" => [
                        'title' => 'Time with God',
                        'description' => 'A series of time with God' ,
                        'year' =>  '2020',
                        'created_at' => now()->setMilliseconds(0)->toJSON(),
                        'updated_at' => now()->setMilliseconds(0)->toJSON(),
                    ]
                ]
            ]);
        $this->assertDatabaseHas('series',[
            'id' => 1,
            'title' => 'Time with God',
            'description' => 'A series of time with God',
            'year' => '2020',
        ]);
    }

    public function testUpdateSeries()
    {
        $series = factory(Series::class)->create();
        $this->postJson('/api/v1/admin/series/1',[
            'data' =>[
                'type' => 'series',
                "attributes" => [
                    'title' => 'Time with God',
                    'description' => 'A series of time with God',
                    'year' => '2020',
                ]
            ]
        ],[
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])->assertStatus(200)
            ->assertJson([
                "data" => [
                    "id" => '1',
                    "type" => 'series',
                    "attributes" => [
                        'title' => 'Time with God',
                        'description' => 'A series of time with God' ,
                        'year' =>  '2020',
                        'created_at' => now()->setMilliseconds(0)->toJSON(),
                        'updated_at' => now() ->setMilliseconds(0)->toJSON(),
                    ]
                ]
            ]);
        $this->assertDatabaseHas('series',[
            'id' => 1,
            'title' => 'Time with God',
            'description' => 'A series of time with God',
            'year' => '2020',
        ]);
    }

    public function testDeleteSeries()
    {
        $series = factory(Series::class)->create();
        $this->delete("api/v1/admin/series/1",[],[
            'accept' => 'application/vnd.api+json',
            'content-type' => 'application/vnd.api+json'
        ])
            ->assertStatus(204);

        $this->assertDatabaseMissing('series',[
            'id' => 1,
            'title' => $series->title,
            'description' => $series->description,
            'year' => $series->year,
            ]);
    }
}
