<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model{
    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    /**
     * The user who created this lesson.
     */
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    /**
     * The topics associated with this lesson (many-to-many).
     */
    public function topics(): BelongsToMany{
        return $this->belongsToMany(Topic::class);
    }
}
