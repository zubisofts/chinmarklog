<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelPickupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcel_pickups', function (Blueprint $table) {
            $table->id();
            $table->string('sender');
            $table->string('reciever');
            $table->string('sender_phone');
            $table->string('reciever_phone');
            $table->string('sender_email');
            $table->string('reciever_email')->nullable();
            $table->string('pickup_location');
            $table->string('delivery_location')->nullable();
            $table->unsignedBigInteger('category_id')->default(1);
            $table->foreign('category_id')->references('id')->on('parcel_categories')->onDelete('cascade');
            $table->string('weight')->nullable();
            $table->mediumText('description')->nullable();
            $table->enum('status', ['unseen', 'seen', 'assigned', 'saved', 'declined'])->default('unseen');
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
        Schema::dropIfExists('parcel_pickups');
    }
}
