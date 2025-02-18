<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->id();
            $table->date('date'); // Entry Date
            $table->foreignId('account_id')->constrained()->onDelete('cascade'); // Account ID (Foreign Key)
            $table->string('description')->nullable(); // Description
            $table->string('currency'); // Currency (e.g., AFN, USD, EUR)
            $table->decimal('debit', 10, 2)->default(0); // Debit Amount
            $table->decimal('credit', 10, 2)->default(0); // Credit Amount
            $table->text('remark')->nullable(); // Additional Remark
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('journal_entries');
    }
};

