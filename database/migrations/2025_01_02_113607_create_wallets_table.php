<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('balance', 15, 2)->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('color_hex', 7)->default('#5e5d5d');
            $table->string('emoji', 1)->default('🪙');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}
