<?php


namespace Tests\Feature;

use App\Models\Series;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SeriesTest extends TestCase
{
    use DatabaseMigrations;

    public function testGetAllSeriesAsCollection()
    {

    }

    public function testGetASeriesAsAResourceObject()
    {
        $series =   factory(Series::class)->create();
        dd('hi');
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

    }

    public function testUpdateSeries()
    {

    }

    public function testDeleteSeries()
    {

    }
}
