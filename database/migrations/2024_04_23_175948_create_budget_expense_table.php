<?php

use App\Models\Budget;
use App\Models\Expense;
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
        Schema::create('budget_expense', function (Blueprint $table) {
            $table->id();
            $table->foreignId(Budget::class)->constrained()->onDelete('cascade');
            $table->foreignId(Expense::class)->constrained()->onDelete('cascade');
            $table->foreignId(User::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_expense');
    }
};
