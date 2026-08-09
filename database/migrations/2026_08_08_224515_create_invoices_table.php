<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();

            $table->foreignId('client_id')
                ->constrained('clients')
                ->cascadeOnDelete();

            $table->date('invoice_date');
            $table->decimal('amount', 10, 2)->default(0);

            $table->enum('status', [
                'draft',
                'paid',
                'unpaid',
                'cancelled'
            ])->default('draft');

            $table->string('pdf_path')->nullable();

            $table->foreignId('created_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
