<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\McqStore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\McqStoreController
 */
class McqStoreControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $mcqStores = McqStore::factory()->count(3)->create();

        $response = $this->get(route('mcq-store.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\McqStoreController::class,
            'store',
            \App\Http\Requests\McqStoreStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $response = $this->post(route('mcq-store.store'));

        $response->assertCreated();
        $response->assertJsonStructure([]);

        $this->assertDatabaseHas('mcqStores', [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $mcqStore = McqStore::factory()->create();

        $response = $this->get(route('mcq-store.show', $mcqStore));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\McqStoreController::class,
            'update',
            \App\Http\Requests\McqStoreUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $mcqStore = McqStore::factory()->create();

        $response = $this->put(route('mcq-store.update', $mcqStore));

        $mcqStore->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $mcqStore = McqStore::factory()->create();

        $response = $this->delete(route('mcq-store.destroy', $mcqStore));

        $response->assertNoContent();

        $this->assertSoftDeleted($mcqStore);
    }
}
