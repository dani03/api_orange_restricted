<?php

use App\Models\Client;
use App\Models\Offre;
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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->integer('numberLicences');
            $table->text('description')->nullable();
            $table->foreignIdFor(Client::class);
            $table->foreignIdFor(Offre::class);
            $table->integer('status')->default(0);
            $table->string('option_technology')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
