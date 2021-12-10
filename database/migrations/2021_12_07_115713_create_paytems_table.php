<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaytemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paytems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained();
            $table->float('price', 8, 2);
            $table->string('txn_id');
            $table->enum('status', ['Paid', 'Failed', 'Cancelled']);
            $table->timestamps();
	        $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paytems');
    }
}
