<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id_from')->constrained();
            $table->foreignId('user_id_to')->constrained();
            $table->foreignId('transaction_id_withdrawal')->constrained();
            $table->foreignId('transaction_id_deposit')->nullable(true);
            $table->enum('status', ['pending', 'accepted', 'cancelled']);
            $table->decimal('amount', $precision = 10, $scale = 2);
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
        Schema::dropIfExists('transfers');
    }
};
