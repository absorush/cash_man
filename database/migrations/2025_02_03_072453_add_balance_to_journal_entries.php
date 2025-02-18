<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('journal_entries', function (Blueprint $table) {
            $table->decimal('balance', 15, 2)->default(0)->after('credit');
        });
    }

    public function down() {
        Schema::table('journal_entries', function (Blueprint $table) {
            $table->dropColumn('balance');
        });
    }
};

