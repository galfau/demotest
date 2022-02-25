<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urls', function(Blueprint $table){
			$table->charset = 'utf8mb4';
    		$table->collation = 'utf8mb4_unicode_ci';

			$table->id();
			$table->string('url')->nullable();
			$table->string('key')->nullable();
			$table->string('title')->nullable();
			$table->integer('visits')->nullable()->default(0);
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
        Schema::dropIfExists('urls');
    }
}
