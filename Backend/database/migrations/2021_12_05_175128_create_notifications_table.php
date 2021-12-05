<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notify_user_id');
            $table->foreign('notify_user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('by_user_id');
            $table->foreign('by_user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('post_id')->nullable();
            $table->foreign('post_id')->references('id')->on('posts')->cascadeOnDelete();
            $table->boolean('notifiable')->default(true);
            $table->boolean('read')->default(false);
            $table->dateTime('read_at')->nullable();
            $table->string('type');
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
        Schema::dropIfExists('notifications');
    }
}
