<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('derps', function (Blueprint $table) {
            $table->id(); //id derp (primary key)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //id pengguna (foreign key)
            $table->string('name'); //nama derp
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('derps');
    }
};
