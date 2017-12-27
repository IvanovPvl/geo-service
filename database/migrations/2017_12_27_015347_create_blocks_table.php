<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->ipAddress('network');
            $table->integer('geoname_id')->unsigned();
            $table->decimal('latitude', 7, 4)->nullable();
            $table->decimal('longitude', 7, 4)->nullable();


            $table->index('geoname_id');
            $table->foreign('geoname_id')
                ->references('id')->on('locations')
                ->onDelete('CASCADE');
        });

        DB::statement('CREATE INDEX idx_network ON blocks USING GIST(network inet_ops);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->dropForeign(['geoname_id']);
        });

        Schema::dropIfExists('blocks');
    }
}
