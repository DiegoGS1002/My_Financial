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
        Schema::table('plans_of_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable()->after('id');
            $table->string('code', 50)->unique()->after('parent_id');
            $table->string('type', 20)->default('despesa')->after('description'); // receita, despesa, ativo, passivo
            $table->boolean('is_selectable')->default(true)->after('type');
            $table->boolean('is_active')->default(true)->after('is_selectable');

            $table->foreign('parent_id')
                ->references('id')
                ->on('plans_of_accounts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans_of_accounts', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn(['parent_id', 'code', 'type', 'is_selectable', 'is_active']);
        });
    }
};
