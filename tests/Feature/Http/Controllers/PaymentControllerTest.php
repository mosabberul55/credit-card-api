<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PaymentController
 */
class PaymentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $payments = Payment::factory()->count(3)->create();

        $response = $this->get(route('payment.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PaymentController::class,
            'store',
            \App\Http\Requests\PaymentStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('payment.store'), [
            'status' => $status,
        ]);

        $payments = Payment::query()
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $payments);
        $payment = $payments->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $payment = Payment::factory()->create();

        $response = $this->get(route('payment.show', $payment));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PaymentController::class,
            'update',
            \App\Http\Requests\PaymentUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $payment = Payment::factory()->create();
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('payment.update', $payment), [
            'status' => $status,
        ]);

        $payment->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($status, $payment->status);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $payment = Payment::factory()->create();

        $response = $this->delete(route('payment.destroy', $payment));

        $response->assertNoContent();

        $this->assertSoftDeleted($payment);
    }
}
