<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTLocaleSlugSeo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_locale_slug_seo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('language',64)->nullable(true);
            $table->string('rel_parent', 255);
            $table->string('slug', 255)->index();
            $table->integer('key')->nullable(true)->index();
            $table->integer('locale_seo_id')->nullable(true)->index();
            $table->string('parent_slug', 255)->nullable(true)->index();
            $table->string('title', 255)->nullable(true);
            $table->string('keywords', 255)->nullable(true);
            $table->string('description', 255)->nullable(true);
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
        Schema::dropIfExists('t_locale_slug_seo');
    }
}
