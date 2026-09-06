<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stock_entries', function (Blueprint $table) {
            $table->binary('document_pdf')->nullable();
        });

        Schema::table('stock_exits', function (Blueprint $table) {
            $table->binary('document_pdf')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('stock_entries', function (Blueprint $table) {
            $table->dropColumn('document_pdf');
        });

        Schema::table('stock_exits', function (Blueprint $table) {
            $table->dropColumn('document_pdf');
        });
    }
};