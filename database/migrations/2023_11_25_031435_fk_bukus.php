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
        Schema::table('bukus', function (Blueprint $table) {
            $table->string('pengarang_id', 8);
            $table->foreign('pengarang_id', 'fk_buku_pengarang_id')->references('id')->on('pengarangs')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('penerbit_id', 8);
            $table->foreign('penerbit_id', 'fk_buku_penerbit_id')->references('id')->on('penerbits')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('rak_id', 8);
            $table->foreign('rak_id', 'fk_buku_rak_id')->references('id')->on('raks')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->dropForeign('fk_buku_pengarang_id');
            $table->dropColumn('pengarang_id');
            $table->dropForeign('fk_buku_penerbit_id');
            $table->dropColumn('penerbit_id');
            $table->dropForeign('fk_buku_rak_id');
            $table->dropColumn('rak_id');
        });
    }
};
