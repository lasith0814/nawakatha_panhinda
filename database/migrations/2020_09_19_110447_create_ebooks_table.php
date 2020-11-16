<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebooks', function (Blueprint $table) {
            $table->id();
            $table->string('book_id')->unique();
            $table->string('name');
            $table->unsignedBigInteger('ebook_category_id');
            $table->unsignedBigInteger('author_id');
//            $table->bigInteger('page_count')->nullable();
            $table->text('intro_quote')->nullable();
            $table->string('thumbnail_img')->nullable();
            $table->string('back_thumbnail_img')->nullable()->default(null);
//            $table->bigInteger('view_count')->nullable();
//            $table->bigInteger('like_count')->nullable();
            $table->auditableWithDeletes();
            $table->timestamps();
            $table->softDeletes();
        });
//            $table->string('api_thumbnail_img')->nullable();
//            $table->string('back_api_thumbnail_img')->nullable();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ebooks');
    }
}
