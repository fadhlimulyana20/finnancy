<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('description', 100);
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->bigInteger('amount');
            $table->date('date');
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
        Schema::table('expenses_plans', function (Blueprint $table) {
            $table->dropForeign('expenses_plans_user_id_foreign');
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('expenses_plans');
    }
}
