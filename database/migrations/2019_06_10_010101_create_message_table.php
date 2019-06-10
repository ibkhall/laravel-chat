<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTable extends Migration {



    public function up() {
        Schema::create(config('khall_chat.messages_table'), function (Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('from_id');
            $table->bigInteger('to_id');
            $table->mediumText('content');
            $table->dateTime('created_at');
            $table->dateTime('read_at')->nullable();
        });
    }



    public function down() {
        Schema::dropIfExists(config('khall_chat.messages_table'));
    }
}