<?php

namespace App\Observers\Blog;

use App\Models\Admin\Blog\Postblog;

class PostblogpostionObserver
{
    /**
     * Handle the category "creating" event.
     *
     * @param  \App\Blog\Postblog  $category
     * @return void
     */
    public function creating(Postblog $postblog)
    {

        if (is_null($postblog->position)) {
            $postblog->position = Postblog::max('position') + 1;
            return;
        }

        $lowerPriorityPost = Postblog::where('position', '>=', $postblog->position)
            ->get();

        foreach ($lowerPriorityPost as $lowerPriorityPostblog) {
            $lowerPriorityPostblog->position++;
            $lowerPriorityPostblog->saveQuietly();
        }
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  \App\Blog\Postblog  $category
     * @return void
     */
    public function updating(Postblog $postblog)
    {

        if ($postblog->isClean('position')) {
            return;
        }

        if (is_null($postblog->position)) {
            $postblog->position = Postblog::max('position');
        }

        if ($postblog->getOriginal('position') > $postblog->position) {
            $positionRange = [
                $postblog->position, $postblog->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $postblog->getOriginal('position'), $postblog->position,
            ];
        }

        $lowerPriorityPost = Postblog::where('id', '!=', $postblog->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityPost as $lowerPriorityPostblog) {
            if ($postblog->getOriginal('position') < $postblog->position) {
                $lowerPriorityPostblog->position--;
            } else {
                $lowerPriorityPostblog->position++;
            }
            $lowerPriorityPostblog->saveQuietly();
        }
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Blog\Postblog  $category
     * @return void
     */
    public function deleted(Postblog $postblog)
    {
        $lowerPriorityPost = Postblog::where('position', '>', $postblog->position)
            ->get();

        foreach ($lowerPriorityPost as $lowerPriorityPostblog) {
            $lowerPriorityPostblog->position--;
            $lowerPriorityPostblog->saveQuietly();
        }
    }
}
