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
        Schema::table('peminjaman_details', function (Blueprint $table) {
            $table->string('peminjaman_id', 8);
            $table->foreign('peminjaman_id', 'fk_peminjaman_details_peminjaman_id')->references('id')->on('peminjamans')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('buku_id', 8);
            $table->foreign('buku_id', 'fk_peminjaman_details_buku_id')->references('id')->on('bukus')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman_details', function (Blueprint $table) {
            $table->dropForeign('fk_peminjaman_details_buku_id');
            $table->dropColumn('buku_id');
            $table->dropForeign('fk_peminjaman_details_peminjaman_id');
            $table->dropColumn('peminjaman_id');
        });
    }
};
