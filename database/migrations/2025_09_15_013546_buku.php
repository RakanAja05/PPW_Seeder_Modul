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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul_buku');
            $table->string('penulis');
            $table->integer('harga');
            $table->timestamp('tanggal_terbit')->nullable(); // custom
            $table->timestamps(); // created_at & updated_at
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
