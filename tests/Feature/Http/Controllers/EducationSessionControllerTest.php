<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\EducationSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\EducationSessionController
 */
class EducationSessionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $educationSessions = EducationSession::factory()->count(3)->create();

        $response = $this->get(route('education-session.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EducationSessionController::class,
            'store',
            \App\Http\Requests\EducationSessionStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $response = $this->post(route('education-session.store'));

        $response->assertCreated();
        $response->assertJsonStructure([]);

        $this->assertDatabaseHas('educationSessions', [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $educationSession = EducationSession::factory()->create();

        $response = $this->get(route('education-session.show', $educationSession));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EducationSessionController::class,
            'update',
            \App\Http\Requests\EducationSessionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $educationSession = EducationSession::factory()->create();

        $response = $this->put(route('education-session.update', $educationSession));

        $educationSession->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $educationSession = EducationSession::factory()->create();

        $response = $this->delete(route('education-session.destroy', $educationSession));

        $response->assertNoContent();

        $this->assertSoftDeleted($educationSession);
    }
}
