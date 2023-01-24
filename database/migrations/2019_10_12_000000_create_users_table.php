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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100)->unique()->collation('utf8mb4_unicode_ci');
            $table->string('name')->collation('utf8mb4_unicode_ci');
            $table->string('email')->unique()->collation('utf8mb4_unicode_ci');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->collation('utf8mb4_unicode_ci');
            $table->string('avatar')->default('default.jpg')->collation('utf8mb4_unicode_ci');
            $table->tinyInteger('admin')->default(null);
            $table->rememberToken();
            $table->tinyInteger('deleted')->default(0);
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
