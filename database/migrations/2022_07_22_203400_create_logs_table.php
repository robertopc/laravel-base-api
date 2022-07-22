<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function(Blueprint $table){
            $table->id();
            $table->timestamp('created_at');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('ip',50)->comment('Ready for ipv4 and ipv6')->index();
            $table->string('action', 30)->comment('Action taken. Ex: CREATE USER')->index();
            $table->string('url', 30)->nullable()->comment('Url');
            $table->text('description')->comment('Description')->nullable();
            $table->text('user_agent', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}