<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Account name (e.g., Cash, Bank, Expenses)
            $table->enum('type', ['income', 'expense', 'bank', 'asset', 'liability']); // Account type
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('accounts');
    }
};

