<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSsrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_ssr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('device_id')->default('')->comment('设备号码');
            $table->string('ssr')->default('')->comment('代理地址');
            $table->string('name')->default('')->comment('代理名称');
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
        Schema::dropIfExists('user_ssr');
    }
}
