<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // فقط اضافه کردن ستون‌ها اگر وجود ندارند
        if (!Schema::hasColumn('chatify_conversation_projects', 'user_id_1')) {
            Schema::table('chatify_conversation_projects', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id_1')->after('id'); // ID کوچکتر
            });
        }
        if (!Schema::hasColumn('chatify_conversation_projects', 'user_id_2')) {
            Schema::table('chatify_conversation_projects', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id_2')->after('user_id_1'); // ID بزرگتر
            });
        }
        if (!Schema::hasColumn('chatify_conversation_projects', 'project_id')) {
            Schema::table('chatify_conversation_projects', function (Blueprint $table) {
                $table->unsignedBigInteger('project_id')->after('user_id_2');
            });
        }
        
        // اضافه کردن indexes و foreign keys (با استفاده از DB facade برای بررسی)
        $connection = DB::connection();
        $connection->statement('SET FOREIGN_KEY_CHECKS=0;');
        
        try {
            // بررسی و اضافه کردن unique constraint
            $indexes = $connection->select("SHOW INDEXES FROM chatify_conversation_projects WHERE Key_name = 'unique_conversation'");
            if (empty($indexes)) {
                Schema::table('chatify_conversation_projects', function (Blueprint $table) {
                    $table->unique(['user_id_1', 'user_id_2'], 'unique_conversation');
                });
            }
            
            // بررسی و اضافه کردن foreign key (با try-catch برای مدیریت خطا)
            try {
                $foreignKeys = $connection->select("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'chatify_conversation_projects' AND CONSTRAINT_NAME = 'chatify_conversation_projects_project_id_foreign'");
                if (empty($foreignKeys)) {
                    Schema::table('chatify_conversation_projects', function (Blueprint $table) {
                        $table->foreign('project_id')->references('id')->on('new_projects')->onDelete('cascade');
                    });
                }
            } catch (\Exception $e) {
                // اگر foreign key اضافه نشد، خطا را نادیده بگیر
                // احتمالاً به دلیل داده‌های موجود است
            }
            
            // بررسی و اضافه کردن index
            $indexes2 = $connection->select("SHOW INDEXES FROM chatify_conversation_projects WHERE Key_name = 'chatify_conversation_projects_user_id_1_user_id_2_index'");
            if (empty($indexes2)) {
                Schema::table('chatify_conversation_projects', function (Blueprint $table) {
                    $table->index(['user_id_1', 'user_id_2']);
                });
            }
        } finally {
            $connection->statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chatify_conversation_projects', function (Blueprint $table) {
            if (Schema::hasColumn('chatify_conversation_projects', 'project_id')) {
                $table->dropForeign(['project_id']);
            }
            $table->dropUnique('unique_conversation');
            $table->dropIndex(['user_id_1', 'user_id_2']);
            $table->dropColumn(['user_id_1', 'user_id_2', 'project_id']);
        });
    }
};
