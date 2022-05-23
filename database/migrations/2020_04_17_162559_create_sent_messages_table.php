<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSentMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sent_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('recipient_phone')->nullable();
            $table->string('message_id')->nullable();
            $table->longText('text')->nullable();
            $table->decimal('cost', 20, 6)->nullable();
            $table->integer('status')->nullable();
            $table->longText('failure_reason')->nullable();

            $table->softDeletes();
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
        Schema::drop('sent_messages');
    }
}
