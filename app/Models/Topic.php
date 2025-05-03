<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Topic Model
 *
 * @property string $name
 * @property int $user_id
 *
 * @method BelongsToMany resources()
 * @method BelongsTo user()
 */
class Topic extends Model{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    /**
     * Get the user that owns the topic.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * The resources that belong to the topic.
     */
    public function resources(){
        return $this->belongsToMany(Resource::class);
    }
}
