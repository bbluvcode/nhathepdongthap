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
        Schema::create('panel_job_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("panel_id");
            $table->string("image");
            $table->boolean("status");
            $table->timestamps();
             // Thiết lập khóa ngoại và ràng buộc
             $table->foreign('panel_id')->references('id')->on('panel_jobs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panel_job_images');
    }
};
