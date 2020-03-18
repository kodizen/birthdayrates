<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRatesToBirthdaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('birthdays', function (Blueprint $table) {
            $table->string('base')->default('GBP')->after('birthday');
            $table->decimal('GBP', 9, 3)->nullable()->after('birthday');
            $table->decimal('USD', 9, 3)->nullable()->after('birthday');
            $table->decimal('EUR', 9, 3)->nullable()->after('birthday');
            $table->decimal('CAD', 9, 3)->nullable()->after('birthday');
            $table->decimal('JPY', 9, 3)->nullable()->after('birthday');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('birthdays', function (Blueprint $table) {
            //
        });
    }
}
