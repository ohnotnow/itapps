<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDhcpSubnetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dhcp_subnets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('network');
            $table->string('netmask');
            $table->integer('network_id')->unsigned()->nullable();
            $table->foreign('network_id')->references('id')->on('dhcp_shared_networks')->onDelete('set null');
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
        Schema::drop('dhcp_subnets');
    }
}
