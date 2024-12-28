<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *  protected $fillable = ["title","order"];
     */
    public function up(): void
    {
        Schema::create('process_sups', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('process_sups');
    }
};
