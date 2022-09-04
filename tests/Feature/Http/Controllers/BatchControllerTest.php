<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Batch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BatchController
 */
class BatchControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $batches = Batch::factory()->count(3)->create();

        $response = $this->get(route('batch.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BatchController::class,
            'store',
            \App\Http\Requests\BatchStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $response = $this->post(route('batch.store'));

        $response->assertCreated();
        $response->assertJsonStructure([]);

        $this->assertDatabaseHas('batches', [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $batch = Batch::factory()->create();

        $response = $this->get(route('batch.show', $batch));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BatchController::class,
            'update',
            \App\Http\Requests\BatchUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $batch = Batch::factory()->create();

        $response = $this->put(route('batch.update', $batch));

        $batch->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $batch = Batch::factory()->create();

        $response = $this->delete(route('batch.destroy', $batch));

        $response->assertNoContent();

        $this->assertSoftDeleted($batch);
    }
}
