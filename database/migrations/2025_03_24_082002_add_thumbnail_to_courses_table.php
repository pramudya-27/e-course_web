<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThumbnailToCoursesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('courses', 'thumbnail')) {
            Schema::table('courses', function (Blueprint $table) {
                $table->string('thumbnail')->nullable()->after('duration');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('courses', 'thumbnail')) {
            Schema::table('courses', function (Blueprint $table) {
                $table->dropColumn('thumbnail');
            });
        }
    }
}