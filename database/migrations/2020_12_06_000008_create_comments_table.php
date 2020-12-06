<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('author_email')->nullable();
            $table->string('author_url')->nullable();
            $table->string('author_ip')->nullable();
            $table->datetime('date');
            $table->datetime('date_gmt');
            $table->longText('content');
            $table->integer('karma')->nullable();
            $table->boolean('approved')->default(0)->nullable();
            $table->string('agent')->nullable();
            $table->string('type')->nullable();
            $table->datetime('approved_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
