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
        Schema::table('pengembalians', function (Blueprint $table) {
            $table->string('member_id', 8);
            $table->foreign('member_id', 'fk_pengembalian_member_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('staff_id', 8);
            $table->foreign('staff_id', 'fk_pengembalian_staff_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('peminjaman_detail_id', 8);
            $table->foreign('peminjaman_detail_id', 'fk_pengembalian_peminjaman_detail_id')->references('id')->on('peminjaman_details')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengembalians', function (Blueprint $table) {
            $table->dropForeign('fk_pengembalian_member_id');
            $table->dropColumn('member_id');
            $table->dropForeign('fk_pengembalian_staff_id');
            $table->dropColumn('staff_id');
            $table->dropForeign('fk_pengembalian_peminjaman_detail_id');
            $table->dropColumn('peminjaman_detail_id');
        });
    }
};
