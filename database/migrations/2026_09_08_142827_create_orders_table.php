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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

    // Compte utilisateur (si connecté)
    $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

    // Référence publique (ex: CLN-2026-000123)
    $table->string('reference')->unique();

    // Vie de la commande
    $table->string('status')->default('pending');
    // pending, paid, shipped, delivered, cancelled, refunded

    $table->string('payment_status')->default('pending');
    // pending, paid, failed, refunded

    $table->string('payment_method')->nullable();
    // card, cash_on_delivery, mobile_money...

    // ===== CLIENT INVITÉ (infos embarquées, pas de compte) =====
    $table->string('first_name');
    $table->string('last_name');
    $table->string('email');
    $table->string('phone');
    $table->string('country');
    $table->string('city');
    $table->string('address');
    $table->string('postal_code')->nullable();
    $table->text('notes')->nullable();

    // ===== Informations d'expédition =====
    $table->string('shipping_method')->nullable();
    $table->string('tracking_number')->nullable();

    // ===== Montants FIGÉS au moment de la commande =====
    $table->string('currency', 3)->default('XAF');
    $table->decimal('subtotal', 10, 2)->default(0);
    $table->decimal('shipping_cost', 10, 2)->default(0);
    $table->decimal('discount', 10, 2)->default(0);
    $table->decimal('total', 10, 2)->default(0);

    $table->string('ip_address', 45)->nullable();

    $table->softDeletes();
    $table->timestamps();

    $table->index(['status', 'created_at']);
    $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
