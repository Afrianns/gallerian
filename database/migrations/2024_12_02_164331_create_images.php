<?php

use App\Models\User;
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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->foreignIdFor(User::class)->nullable()->constrained();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('tags')->nullable();
            $table->text('description')->nullable();
            $table->enum('is_reviewed',['not-yet','pending','approved','rejected'])->default('not-yet');
            $table->softDeletesTz('deleted_at', precision: 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
