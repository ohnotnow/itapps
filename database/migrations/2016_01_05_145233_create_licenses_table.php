<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('hostname')->nullable();
            $table->integer('port')->nullable();
            $table->string('contact');
            $table->date('purchased_at')->nullable();
            $table->date('expires_at')->nullable();
            $table->integer('license_type_id')->unsigned()->nullable();
            $table->foreign('license_type_id')->references('id')->on('license_types')->onDelete('set null');
            $table->string('description')->nullable();
            $table->integer('number')->nullable();
            $table->integer('license_scope_id')->unsigned()->nullable();
            $table->foreign('license_scope_id')->references('id')->on('license_scopes')->onDelete('set null');
            $table->string('restrictions')->nullable();
            $table->string('supplier')->nullable();
            $table->float('price')->nullable();
            $table->boolean('is_maintained')->default(false);
            $table->float('maintainance_price')->nullable();
            $table->text('notes')->nullable();
            $table->integer('unit_id')->unsigned()->nullable();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('set null');
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
        Schema::drop('licenses');
    }
}
