<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoice_item_taxes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_item_id')->constrained()->onDelete('cascade');
            $table->string('tax_type');
            $table->decimal('tax_rate', 5, 2);
            $table->decimal('tax_amount', 15, 9);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice_item_taxes');
    }
};
