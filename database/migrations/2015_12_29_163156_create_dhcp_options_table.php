<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDhcpOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dhcp_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subnet_id')->unsigned()->nullable();
            $table->foreign('subnet_id')->references('id')->on('dhcp_subnets')->onDelete('cascade');
            $table->boolean('is_optional')->default(true);
            $table->string('name');
            $table->string('value')->nullable();
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
        Schema::drop('dhcp_options');
    }
}
