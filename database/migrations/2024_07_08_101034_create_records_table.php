<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->string('request_nr');
            $table->string('to');
            $table->string('from');
            $table->string('cargo');
            $table->integer('units');
            $table->string('customs_status');
            $table->float('weight');
            $table->integer('qty');
            $table->string('customs_dekl_nr');
            $table->string('alcohol_name')->nullable();
            $table->string('hs_code')->nullable();
            $table->float('alc_strength')->nullable();
            $table->float('volume')->nullable();
            $table->integer('pcs_in_box')->nullable();
            $table->integer('boxes')->nullable();
            $table->string('alcohol_comments')->nullable();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
