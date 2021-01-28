<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->string('trackingid');
            $table->string('sender');
            $table->string('reciever');
            $table->string('sender_phone');
            $table->string('reciever_phone');
            $table->string('sender_email');
            $table->string('reciever_email')->nullable();
            $table->string('reciever_address');
            $table->unsignedBigInteger('destination_state_id')->nullable();
            $table->foreign('destination_state_id')->references('id')->on('states')->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->default(1);
            $table->foreign('category_id')->references('id')->on('parcel_categories')->onDelete('cascade');
            $table->string('weight')->nullable();
            $table->mediumText('description')->nullable();
            $table->unsignedBigInteger('current_address');
            $table->foreign('current_address')->references('id')->on('states')->onDelete('cascade');
            $table->enum('status', ['unassigned', 'assigned', 'transit', 'stopped', 'delivered'])->default('unassigned');
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
        Schema::dropIfExists('parcels');
    }
}
