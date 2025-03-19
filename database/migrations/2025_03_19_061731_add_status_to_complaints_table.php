<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('status')->default('New'); // Add status column with default value
        });
    }

    public function down()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn('status'); // Rollback changes if needed
        });
    }
};

