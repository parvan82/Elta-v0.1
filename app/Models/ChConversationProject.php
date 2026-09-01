<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChConversationProject extends Model
{
    use HasFactory;
    
    protected $table = 'chatify_conversation_projects';
    
    protected $fillable = [
        'user_id_1',
        'user_id_2',
        'project_id',
    ];
    
    public function project()
    {
        return $this->belongsTo(NewProject::class, 'project_id');
    }
    
    /**
     * پیدا کردن یا ایجاد project برای یک conversation
     */
    public static function getProjectForConversation($userId1, $userId2)
    {
        // Sort کردن IDs برای consistency
        $ids = [intval($userId1), intval($userId2)];
        sort($ids);
        
        return self::where('user_id_1', $ids[0])
            ->where('user_id_2', $ids[1])
            ->first();
    }
    
    /**
     * ذخیره یا به‌روزرسانی project برای یک conversation
     */
    public static function setProjectForConversation($userId1, $userId2, $projectId)
    {
        // Sort کردن IDs برای consistency
        $ids = [intval($userId1), intval($userId2)];
        sort($ids);
        
        return self::updateOrCreate(
            [
                'user_id_1' => $ids[0],
                'user_id_2' => $ids[1],
            ],
            [
                'project_id' => $projectId,
            ]
        );
    }
}
