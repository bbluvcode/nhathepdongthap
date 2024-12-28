<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *  protected $fillable = ["phone","address1","address2","logo","email"];
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string("phone");
            $table->string("address1");
            $table->string("address2")->nullable(true);
            $table->string("logo");
            $table->string("email");
            $table->string("person");
            $table->string("sologan1");
            $table->string("sologan2");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
