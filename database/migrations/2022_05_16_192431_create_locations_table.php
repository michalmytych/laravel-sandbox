<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Again, this table is meant to be heavy
         * for caching mechanism learning purposes.
         */
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('basic_description_md');
            $table->text('basic_description_html');
            $table->text('basic_description_xml');
            $table->text('basic_description_yml');
            $table->json('basic_description_json');
            $table->text('basic_description_csv');
            $table->text('basic_description_txt');
            $table->json('meta');
            $table->text('mesh_base64');
            $table->decimal('decimal_degree_latitude', 7, 5);
            $table->decimal('decimal_degree_longitude', 7, 5);
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
        Schema::dropIfExists('locations');
    }
};
