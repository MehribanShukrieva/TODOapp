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
        Schema::table('tasks', function (Blueprint $table) {
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium')->after('status');
            $table->date('due_date')->nullable()->after('priority');
            $table->unsignedInteger('sort_order')->default(0)->after('due_date');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->string('color', 7)->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(['priority', 'due_date', 'sort_order']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
};
