<?php

use App\Models\Budget;
use App\Models\Income;
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
        Schema::create('budget_income', function (Blueprint $table) {
            $table->id();
            $table->foreignId(Budget::class)->constrained();
            $table->foreignId(Income::class)->constrained();
            $table->foreignId(User::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_income');
    }
};
