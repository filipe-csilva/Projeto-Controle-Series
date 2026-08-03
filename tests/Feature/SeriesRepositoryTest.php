<?php

namespace Tests\Feature;

use App\Http\Requests\SeriesFormRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Repositories\Interfaces\ISeriesRepository;
use Tests\TestCase;

class SeriesRepositoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_when_a_series_is_created_its_seasons_and_episodes_must_also_be_created(): void
    {        
        $serieTeste = 'Testando';

        //Arrange
        /**
         * @var ISeriesRepository $repository
         */
        $repository = $this->app->make(ISeriesRepository::class);
        $request = new SeriesFormRequest();
        $request->name = $serieTeste;
        $request->seasonsQty = 1;
        $request->episodesPerSeason = 1;
        
        //Act
        $repository->add($request);
        
        //Assert
        $this->assertDatabaseHas('series', ['name' => $serieTeste]);
    }
}
