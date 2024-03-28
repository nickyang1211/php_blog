<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('标题');
            $table->text('body')->comment('正文');
            $table->jsonb('record')->comment('编辑记录');
            $table->string('author')->comment('作者');
            $table->string('image')->nullable()->comment('图片');
            $table->timestamp('created_at')->comment('创建时间');
            $table->timestamp('updated_at')->comment('更新时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};
