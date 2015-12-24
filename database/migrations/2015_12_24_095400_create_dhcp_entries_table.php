<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDhcpEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dhcp_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mac');
            $table->string('hostname');
            $table->string('ip')->nullable();
            $table->string('added_by')->nullable();
            $table->string('owner_email')->nullable();
            $table->boolean('is_wireless')->default(false);
            $table->boolean('is_disabled')->default(false);
            $table->boolean('is_ssd')->default(false);
            $table->text('notes')->nullable();
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
        Schema::drop('dhcp_entries');
    }
}
