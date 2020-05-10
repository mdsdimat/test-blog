<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogPost
 * @package App\Models
 *
 * @property BlogCategory $category
 * @property User $user
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $excerpt
 * @property string $content_raw
 * @property string $content_html
 * @property string $published_at
 * @property boolean $is_published
 * @property integer $category_id
 * @property integer $user_id
 */
class BlogPost extends Model
{

    use SoftDeletes;

    const UNKNOWN_USER = 1;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'excerpt',
        'content_raw',
        'is_published',
        'published_at',
        'user_id',
    ];

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
