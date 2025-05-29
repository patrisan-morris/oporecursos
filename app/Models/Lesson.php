<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model{
    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

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
        'name' => ['label' => 'Name', 'type' => 'text', 'formable'=> true, 'formClass'=> 'col-span-6','autocomplete' => 'name'],
        'parent_id' => ['label' => 'Parent', 'type' => 'select', 'formable'=> true, 'formClass'=> 'col-span-5','autocomplete' => 'off', 'tableable' => ['parent'=>'name']],
        'order' => ['label' => 'Order', 'type' => 'number', 'formable'=> true, 'formClass'=> 'col-span-1','autocomplete' => 'off'],
        'color' => ['label' => 'Color', 'type' => 'color', 'formable'=> true, 'formClass'=> 'col-span-3','autocomplete' => 'off'],
        'icon' => ['label' => 'Icon', 'type' => 'icon', 'formable'=> true, 'formClass'=> 'col-span-3','autocomplete' => 'off'],
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
