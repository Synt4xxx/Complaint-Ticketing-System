<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('drugstore_name');
            $table->string('complaint_type');
            $table->date('incident_date');
            // These columns might already exist, add only if they don't
            if (!Schema::hasColumn('complaints', 'priority')) {
                $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('low');
            }
            if (!Schema::hasColumn('complaints', 'status')) {
                $table->enum('status', ['New', 'In Progress', 'Resolved', 'Closed'])->default('New');
            }
        });
    }

    public function down()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn([
                'drugstore_name',
                'complaint_type',
                'incident_date'
            ]);
        });
    }
};