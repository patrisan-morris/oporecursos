<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Resource Model
 *
 * @property string $title
 * @property string|null $description
 * @property string|null $link
 * @property string|null $file_path
 * @property int $user_id
 *
 * @method BelongsTo user()
 * @method BelongsToMany topics()
 */
class Resource extends Model{
    use HasFactory;

    protected $fillable = ['title', 'description', 'link', 'file_path', 'user_id'];

    /**
     * Get the user that owns the resource.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * The topics that belong to the resource.
     */
    public function topics(){
        return $this->belongsToMany(Topic::class);
    }
}
