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
 * @property int $parent_id
 * @property string $color
 * @property string $icon
 * @property int $order
 *
 *
 * @method BelongsToMany resources()
 * @method BelongsTo user()
 * @method BelongsTo parent()
 *
 */
class Topic extends Model{
    use HasFactory;

    protected $fillable = ['name', 'user_id', 'parent_id', 'color', 'icon', 'order'];
    public static array $tableColumns = [
        'name' => ['label' => 'Name', 'listable' => true, 'sortable' => true, 'align' => 'left','type' => 'text', 'formable'=> true, 'formClass'=> 'col-span-6','autocomplete' => 'name'],
        'parent_id' => ['label' => 'Parent', 'listable' => true, 'sortable' => true, 'align' => 'center','type' => 'select', 'formable'=> true, 'formClass'=> 'col-span-5','autocomplete' => 'off', 'tableable' => ['parent'=>'name']],
        'order' => ['label' => 'Order', 'listable' => false, 'sortable' => true, 'align' => 'center','type' => 'number', 'formable'=> true, 'formClass'=> 'col-span-1','autocomplete' => 'off'],
        'color' => ['label' => 'Color', 'listable' => true, 'sortable' => true, 'align' => 'center','type' => 'color', 'formable'=> true, 'formClass'=> 'col-span-3','autocomplete' => 'off'],
        'icon' => ['label' => 'Icon', 'listable' => true, 'sortable' => true, 'align' => 'center','type' => 'icon', 'formable'=> true, 'formClass'=> 'col-span-3','autocomplete' => 'off'],
        'created_at' => ['label' => 'Created At', 'listable' => true, 'sortable' => true, 'align' => 'center','type' => 'date', 'formable'=> false, 'formClass'=> 'col-span-3','autocomplete' => 'off'],
        'updated_at' => ['label' => 'Updated At', 'listable' => true, 'sortable' => true, 'align' => 'center','type' => 'date', 'formable'=> false, 'formClass'=> 'col-span-3','autocomplete' => 'off'],
        'actions' => ['label' => '', 'listable' => true, 'sortable' => false, 'align' => 'right', 'type' => null, 'formable'=> false, 'formClass'=> 'col-span-3','autocomplete' => 'off'],
    ];
    public static array $filterColumns = [
        'color' => ['label' => 'Color', 'type' => 'color'],
        'icon' => ['label' => 'Icon', 'type' => 'icon'],
        'created' => ['label' => 'Created', 'type' => 'array', 'elements' => [['id' => 'created_from','label' => 'From', 'type' => 'date'],['id' => 'created_to','label' => 'To', 'type' => 'date']]],
        'updated' => ['label' => 'Updated', 'type' => 'array', 'elements' => [['id' => 'updated_from','label' => 'From', 'type' => 'date'],['id' => 'updated_to','label' => 'To', 'type' => 'date']]],
    ];

    /**
     * Get the user that owns the topic.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent topic.
     */
    public function parent(){
        return $this->belongsTo(Topic::class, 'parent_id');
    }

    /**
     * Get the child topics.
     */
    public function children(){
        return $this->hasMany(Topic::class, 'parent_id');
    }


    /**
     * Get the lessons.
     */
    public function lessons(){
        return $this->belongsToMany(Lesson::class);
    }

    /**
     * The resources that belong to the topic.
     */
    public function resources(){
        return $this->belongsToMany(Resource::class);
    }
}
