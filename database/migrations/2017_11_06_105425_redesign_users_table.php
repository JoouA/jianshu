<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RedesignUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->default('')->change();
            $table->string('QQ',16)->default('')->change();
            $table->string('phone',16)->default('')->change();
            $table->string('weiBo')->default('')->change();
            $table->string('gitHub',100)->default('')->change();
            $table->string('web')->default('')->change();
            $table->string('city',50)->default('')->change();
            $table->text('bio')->nullable()->change();
            $table->string('nickname',100)->default('')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
