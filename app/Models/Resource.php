<?php

namespace App\Models;

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
