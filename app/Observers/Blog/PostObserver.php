<?php

namespace App\Observers\Blog;

use App\Models\BlogPost;
use Carbon\Carbon;

class PostObserver
{
    /**
     * Handle the blog post "created" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post post "creating" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function creating(BlogPost $blogPost)
    {
        $this->setSlug($blogPost);

        $this->setPublishedAt($blogPost);

        $this->setHtml($blogPost);

        $this->setUser($blogPost);
    }

    /**
     * Handle the blog post "updated" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "updating" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function updating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);

        $this->setHtml($blogPost);
    }


    /**
     * Handle the blog post "deleted" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "deleting" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function deleting(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * @param BlogPost $blogPost
     * @return void
     */
    protected function setPublishedAt($blogPost)
    {
        if (empty($blogPost->published_at) && $blogPost->is_published) {
            $blogPost->published_at = Carbon::now();
        }
    }

    /**
     * @param BlogPost $blogPost
     * @return void
     */
    protected function setSlug(BlogPost $blogPost)
    {
        if (empty($blogPost->slug)){
            $blogPost->slug = \Str::slug($blogPost->title);
        }
    }

    /**
     * set content html
     * @param BlogPost $blogPost
     * @return void
     */
    protected function setHtml(BlogPost $blogPost)
    {
        if ($blogPost->isDirty('content_raw')) {
            $blogPost->content_html = $blogPost->content_raw;
        }
    }

    /**
     * set user_id
     * @param BlogPost $blogPost
     * @return void
     */
    protected function setUser(BlogPost $blogPost)
    {
        $blogPost->user_id = auth()->id() ?? BlogPost::UNKNOWN_USER;
    }


}
