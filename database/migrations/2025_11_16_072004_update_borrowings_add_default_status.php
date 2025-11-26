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
    Schema::table('borrowings', function (Blueprint $table) {
        // jika kolom status sudah ada → ubah default
        if (Schema::hasColumn('borrowings', 'status')) {
            $table->string('status')->default('pending')->change();
        } 
        // jika belum ada → tambahkan
        else {
            $table->string('status')->default('pending');
        }
    });
}

public function down()
{
    Schema::table('borrowings', function (Blueprint $table) {
        $table->string('status')->default(null)->change();
    });
}

};
