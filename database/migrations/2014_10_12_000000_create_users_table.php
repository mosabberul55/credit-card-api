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
        Schema::disableForeignKeyConstraints();

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->string('name')->nullable();
            $table->string('username')->nullable()->unique();
            $table->string('photo')->nullable();
            $table->string('phone')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('password')->nullable();
            $table->foreignId('department_id')->nullable()->constrained('departments');
            $table->date('dob')->nullable();
            $table->enum('gender',['male','female','others'])->nullable();
            $table->string('ip')->nullable();
            $table->boolean('approved')->nullable()->default(true);
            $table->boolean('active')->nullable()->default(true);
            $table->enum('type', ['admin', 'employee', 'customer'])->nullable()->default('employee');
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
        Schema::dropIfExists('users');
    }
};
