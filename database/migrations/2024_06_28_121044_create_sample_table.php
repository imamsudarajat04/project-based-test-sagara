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
        Schema::create('sample', function (Blueprint $table) {
            $table->id();
            $table->string('pc');
            $table->string('trx');
            $table->timestamp('tanggal_trx');
            $table->string('produk');
            $table->integer('qty');
            $table->integer('no_tujuan');
            $table->string('kode_seller');
            $table->string('reseller');
            $table->string('modul');
            $table->string('status');
            $table->timestamp('tanggal_status')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->string('nama_supplier');
            $table->integer('stock');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->integer('komisi');
            $table->integer('laba');
            $table->integer('poin');
            $table->longText('reply_provider');
            $table->string('sn');
            $table->string('ref_id');
            $table->string('rate_tp');
            $table->string('rate');
            $table->string('shell');
            $table->string('hbfix');
            $table->string('notes');
            $table->string('kode_provider');
            $table->string('provider');
            $table->string('kode_produk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sample');
    }
};
