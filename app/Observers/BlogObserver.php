<?php

namespace App\Observers;

use App\Models\Blog;

class BlogObserver
{
    /**
     * Handle the Blog "created" event.
     */
    public function created(Blog $blog): void
    {
        // Clear Cache after creating a new blog
        cache()->forget('blogs');
    }

    /**
     * Handle the Blog "updated" event.
     */
    public function updated(Blog $blog): void
    {
        // Clear Cache after creating a blog updated
        cache()->forget('blogs');
    }

    /**
     * Handle the Blog "deleted" event.
     */
    public function deleted(Blog $blog): void
    {
        // Clear Cache after creating a blog deleted
        cache()->forget('blogs');
    }

}
