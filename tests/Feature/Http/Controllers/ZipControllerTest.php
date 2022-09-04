<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Zip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ZipController
 */
class ZipControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $zips = Zip::factory()->count(3)->create();

        $response = $this->get(route('zip.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ZipController::class,
            'store',
            \App\Http\Requests\ZipStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $response = $this->post(route('zip.store'));

        $response->assertCreated();
        $response->assertJsonStructure([]);

        $this->assertDatabaseHas('zips', [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $zip = Zip::factory()->create();

        $response = $this->get(route('zip.show', $zip));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ZipController::class,
            'update',
            \App\Http\Requests\ZipUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $zip = Zip::factory()->create();

        $response = $this->put(route('zip.update', $zip));

        $zip->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $zip = Zip::factory()->create();

        $response = $this->delete(route('zip.destroy', $zip));

        $response->assertNoContent();

        $this->assertSoftDeleted($zip);
    }
}
