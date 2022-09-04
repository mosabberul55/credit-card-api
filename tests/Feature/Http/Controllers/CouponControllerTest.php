<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CouponController
 */
class CouponControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $coupons = Coupon::factory()->count(3)->create();

        $response = $this->get(route('coupon.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CouponController::class,
            'store',
            \App\Http\Requests\CouponStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $discount_type = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('coupon.store'), [
            'discount_type' => $discount_type,
        ]);

        $coupons = Coupon::query()
            ->where('discount_type', $discount_type)
            ->get();
        $this->assertCount(1, $coupons);
        $coupon = $coupons->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $coupon = Coupon::factory()->create();

        $response = $this->get(route('coupon.show', $coupon));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CouponController::class,
            'update',
            \App\Http\Requests\CouponUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $coupon = Coupon::factory()->create();
        $discount_type = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('coupon.update', $coupon), [
            'discount_type' => $discount_type,
        ]);

        $coupon->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($discount_type, $coupon->discount_type);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $coupon = Coupon::factory()->create();

        $response = $this->delete(route('coupon.destroy', $coupon));

        $response->assertNoContent();

        $this->assertSoftDeleted($coupon);
    }
}
