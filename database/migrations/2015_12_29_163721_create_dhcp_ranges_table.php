<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDhcpRangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dhcp_ranges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subnet_id')->unsigned();
            $table->foreign('subnet_id')->references('id')->on('dhcp_subnets')->onDelete('cascade');
            $table->string('start');
            $table->string('end');
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
        Schema::drop('dhcp_ranges');
    }
}
