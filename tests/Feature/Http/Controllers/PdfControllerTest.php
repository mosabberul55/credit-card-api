<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Pdf;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PdfController
 */
class PdfControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $pdfs = Pdf::factory()->count(3)->create();

        $response = $this->get(route('pdf.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PdfController::class,
            'store',
            \App\Http\Requests\PdfStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $response = $this->post(route('pdf.store'));

        $response->assertCreated();
        $response->assertJsonStructure([]);

        $this->assertDatabaseHas('pdfs', [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $pdf = Pdf::factory()->create();

        $response = $this->get(route('pdf.show', $pdf));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PdfController::class,
            'update',
            \App\Http\Requests\PdfUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $pdf = Pdf::factory()->create();

        $response = $this->put(route('pdf.update', $pdf));

        $pdf->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $pdf = Pdf::factory()->create();

        $response = $this->delete(route('pdf.destroy', $pdf));

        $response->assertNoContent();

        $this->assertSoftDeleted($pdf);
    }
}
