<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Mcq;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\McqController
 */
class McqControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $mcqs = Mcq::factory()->count(3)->create();

        $response = $this->get(route('mcq.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\McqController::class,
            'store',
            \App\Http\Requests\McqStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $response = $this->post(route('mcq.store'));

        $response->assertCreated();
        $response->assertJsonStructure([]);

        $this->assertDatabaseHas('mcqs', [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $mcq = Mcq::factory()->create();

        $response = $this->get(route('mcq.show', $mcq));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\McqController::class,
            'update',
            \App\Http\Requests\McqUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $mcq = Mcq::factory()->create();

        $response = $this->put(route('mcq.update', $mcq));

        $mcq->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $mcq = Mcq::factory()->create();

        $response = $this->delete(route('mcq.destroy', $mcq));

        $response->assertNoContent();

        $this->assertSoftDeleted($mcq);
    }
}
