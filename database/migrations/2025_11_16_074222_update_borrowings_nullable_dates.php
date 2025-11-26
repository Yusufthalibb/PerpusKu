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
        $table->date('borrow_date')->nullable()->change();
        $table->date('return_date')->nullable()->change();
        $table->date('actual_return_date')->nullable()->change();
    });
}

public function down()
{
    Schema::table('borrowings', function (Blueprint $table) {
        $table->date('borrow_date')->nullable(false)->change();
        $table->date('return_date')->nullable(false)->change();
        $table->date('actual_return_date')->nullable(false)->change();
    });
}

};
