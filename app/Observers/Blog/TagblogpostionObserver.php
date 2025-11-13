<?php

namespace App\Observers\Blog;

use App\Models\Admin\Blog\Tagblog;

class TagblogpostionObserver
{
    /**
     * Handle the category "creating" event.
     *
     * @param  \App\Blog\Tagblog  $category
     * @return void
     */
    public function creating(Tagblog $tagblog)
    {

        if (is_null($tagblog->position)) {
            $tagblog->position = Tagblog::max('position') + 1;
            return;
        }

        $lowerPriorityTag = Tagblog::where('position', '>=', $tagblog->position)
            ->get();

        foreach ($lowerPriorityTag as $lowerPriorityTagblog) {
            $lowerPriorityTagblog->position++;
            $lowerPriorityTagblog->saveQuietly();
        }
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  \App\Blog\Tagblog  $category
     * @return void
     */
    public function updating(Tagblog $tagblog)
    {

        if ($tagblog->isClean('position')) {
            return;
        }

        if (is_null($tagblog->position)) {
            $tagblog->position = Tagblog::max('position');
        }

        if ($tagblog->getOriginal('position') > $tagblog->position) {
            $positionRange = [
                $tagblog->position, $tagblog->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $tagblog->getOriginal('position'), $tagblog->position,
            ];
        }

        $lowerPriorityTag = Tagblog::where('id', '!=', $tagblog->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityTag as $lowerPriorityTagblog) {
            if ($tagblog->getOriginal('position') < $tagblog->position) {
                $lowerPriorityTagblog->position--;
            } else {
                $lowerPriorityTagblog->position++;
            }
            $lowerPriorityTagblog->saveQuietly();
        }
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Blog\Tagblog  $category
     * @return void
     */
    public function deleted(Tagblog $tagblog)
    {
        $lowerPriorityTag = Tagblog::where('position', '>', $tagblog->position)
            ->get();

        foreach ($lowerPriorityTag as $lowerPriorityTagblog) {
            $lowerPriorityTagblog->position--;
            $lowerPriorityTagblog->saveQuietly();
        }
    }
}
