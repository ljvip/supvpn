<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserUrlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_url', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('device_id')->default('')->comment('设备号码');
            $table->string('url')->default('')->comment('网址');
            $table->string('name')->default('')->comment('网站名称');
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
        Schema::dropIfExists('user_url');
    }
}
