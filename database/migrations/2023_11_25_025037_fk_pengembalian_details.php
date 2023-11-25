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
        Schema::table('pengembalian_details', function (Blueprint $table) {
            $table->string('pengembalian_id', 8);
            $table->foreign('pengembalian_id', 'fk_pengembalian_details_pengembalian_id')->references('id')->on('pengembalians')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('buku_id', 8);
            $table->foreign('buku_id', 'fk_pengembalian_details_buku_id')->references('id')->on('bukus')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengembalian_details', function (Blueprint $table) {
            $table->dropForeign('fk_pengembalian_details_buku_id');
            $table->dropColumn('buku_id');
            $table->dropForeign('fk_pengembalian_details_peminjaman_id');
            $table->dropColumn('pengembalian_id');
        });
    }
};
