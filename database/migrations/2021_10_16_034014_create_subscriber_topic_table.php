<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriberTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriber_topic', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->bigInteger('subscriber_id')->unsigned()->index();
            $table->foreign('subscriber_id')
                ->references('id')->on('subscribers')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('topic_id')->unsigned()->index();
            $table->foreign('topic_id')
                ->references('id')->on('topics')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->primary(['subscriber_id', 'topic_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriber_topic');
    }
}
