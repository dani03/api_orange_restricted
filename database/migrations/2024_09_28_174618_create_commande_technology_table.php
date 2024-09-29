<?php

use App\Models\Commande;
use App\Models\Technology;
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
        Schema::create('commande_technology', function (Blueprint $table) {
            $table->foreignIdFor(Commande::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Technology::class)->constrained()->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande_technology');
    }
};
