<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('set null');
            $table->string('invoice_number');
            $table->enum('type',['standard','simplified','credit_note']);
            $table->foreignId('original_invoice_id')->nullable()->constrained('invoices')->onDelete('set null');
            $table->dateTime('issue_date');
            $table->enum('payment_method',['cash','credit']);
            $table->decimal('subtotal',15,9);
            $table->decimal('tax_total',15,9);
            $table->decimal('total',15,9);
            $table->string('currency',3)->default('JOD');
            $table->enum('status',['draft','sent','approved','rejected']);
            $table->uuid('national_uuid')->nullable();
            $table->text('digital_signature')->nullable();
            $table->text('qr_code_data')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('validated_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
