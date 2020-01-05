<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // group_chat群聊
        Schema::create('group_chat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number')->comment('群编号，方便查找群');
            $table->string('name')->comment('群名称');
            $table->bigInteger('user_id')->comment('群组id');
            $table->string('avatar')->nullable()->comment('群头像');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_chat');
    }
}
