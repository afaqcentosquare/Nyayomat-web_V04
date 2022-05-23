<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disbursements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->decimal('amount', 20, 6)->nullable();
            $table->string('recipient_phone')->nullable();
            $table->string('conversation_id')->nullable();
            $table->string('originator_conversation_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('receiver_name')->nullable();
            $table->decimal('charges', 20, 6)->nullable();
            $table->decimal('utility_balance', 20, 6)->nullable();
            $table->decimal('working_balance', 20, 6)->nullable();
            $table->string('transaction_completed_at')->nullable();
            $table->integer('status')->nullable();
            $table->longText('failure_reason')->nullable();
            $table->timestamp('callback_at')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('disbursements');
    }
}
