<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SubscriptionController
 */
class SubscriptionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $subscriptions = Subscription::factory()->count(3)->create();

        $response = $this->get(route('subscription.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SubscriptionController::class,
            'store',
            \App\Http\Requests\SubscriptionStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $response = $this->post(route('subscription.store'));

        $response->assertCreated();
        $response->assertJsonStructure([]);

        $this->assertDatabaseHas('subscriptions', [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $subscription = Subscription::factory()->create();

        $response = $this->get(route('subscription.show', $subscription));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SubscriptionController::class,
            'update',
            \App\Http\Requests\SubscriptionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $subscription = Subscription::factory()->create();

        $response = $this->put(route('subscription.update', $subscription));

        $subscription->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $subscription = Subscription::factory()->create();

        $response = $this->delete(route('subscription.destroy', $subscription));

        $response->assertNoContent();

        $this->assertSoftDeleted($subscription);
    }
}
