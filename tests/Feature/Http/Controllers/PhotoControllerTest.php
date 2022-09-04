<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Photo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PhotoController
 */
class PhotoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $photos = Photo::factory()->count(3)->create();

        $response = $this->get(route('photo.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PhotoController::class,
            'store',
            \App\Http\Requests\PhotoStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $response = $this->post(route('photo.store'));

        $response->assertCreated();
        $response->assertJsonStructure([]);

        $this->assertDatabaseHas('photos', [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $photo = Photo::factory()->create();

        $response = $this->get(route('photo.show', $photo));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PhotoController::class,
            'update',
            \App\Http\Requests\PhotoUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $photo = Photo::factory()->create();

        $response = $this->put(route('photo.update', $photo));

        $photo->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $photo = Photo::factory()->create();

        $response = $this->delete(route('photo.destroy', $photo));

        $response->assertNoContent();

        $this->assertSoftDeleted($photo);
    }
}
