<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('bookset', function (Blueprint $table) {
            $table->unsignedBigInteger('SetID')->nullable(); // hoặc sử dụng kiểu dữ liệu phù hợp
            $table->foreign('SetID')->references('SetID')->on('BookSet')->onDelete('cascade'); // Thiết lập khóa ngoại
        });
    }

    public function down()
    {
        Schema::table('bookset', function (Blueprint $table) {
            $table->dropForeign(['SetID']); // Xóa ràng buộc khóa ngoại
            $table->dropColumn('SetID'); // Xóa cột
        });
    }

};
