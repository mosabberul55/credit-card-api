<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Audio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AudioController
 */
class AudioControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $audio = Audio::factory()->count(3)->create();

        $response = $this->get(route('audio.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AudioController::class,
            'store',
            \App\Http\Requests\AudioStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $response = $this->post(route('audio.store'));

        $response->assertCreated();
        $response->assertJsonStructure([]);

        $this->assertDatabaseHas('audio', [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $audio = Audio::factory()->create();

        $response = $this->get(route('audio.show', $audio));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AudioController::class,
            'update',
            \App\Http\Requests\AudioUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $audio = Audio::factory()->create();

        $response = $this->put(route('audio.update', $audio));

        $audio->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $audio = Audio::factory()->create();

        $response = $this->delete(route('audio.destroy', $audio));

        $response->assertNoContent();

        $this->assertSoftDeleted($audio);
    }
}
