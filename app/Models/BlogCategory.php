<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * BlogCategory
 *
 * @mixin Eloquent
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property-read BlogCategory $parentCategory
 * @property-read string $parentTitle
 */

class BlogCategory extends Model
{
    use SoftDeletes;

    const ROOT_ID = 1;

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description',
    ];

    /**
     * @return BelongsTo
     */
    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    /**
     * accessor
     * @return string
     */
    public function getParentTitleAttribute()
    {
        return $this->parentCategory->title
            ?? ($this->isRoot()?'root':'error');
    }

    /**
     * @return boolean
     */
    private function isRoot()
    {
        return $this->id === self::ROOT_ID;
    }
}
