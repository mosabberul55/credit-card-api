<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('card_category_id')->nullable()->constrained('card_categories');
            $table->string('customer_name')->nullable();
            $table->string('organization_name')->nullable();
            $table->string('card_number')->nullable();
            $table->enum('card_type', ['primary','supply'])->nullable();
            $table->string('client_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('refrm')->nullable();
            $table->string('rm_code')->nullable();
            $table->enum('status', ['active', 'pending', 'rejected', 'expired'])->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_applications');
    }
};
