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
        Schema::create('materi_ajar', function (Blueprint $table) {
            $table->id();
            $table->uuid("user_id");
            $table->bigInteger("mapel_id");
            $table->string("judul_materi");
            $table->string("pembuat_materi");
            $table->text("deskripsi_materi");
            $table->string("link_materi");
            $table->string("cover_foto")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi_ajar');
    }
};
