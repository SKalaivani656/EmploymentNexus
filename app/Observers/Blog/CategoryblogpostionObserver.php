<?php

namespace App\Observers\Blog;

use App\Models\Admin\Blog\Categoryblog;

class CategoryblogpostionObserver
{
    /**
     * Handle the category "creating" event.
     *
     * @param  \App\Categoryblog  $category
     * @return void
     */
    public function creating(Categoryblog $categoryblog)
    {

        if (is_null($categoryblog->position)) {
            $categoryblog->position = Categoryblog::max('position') + 1;
            return;
        }

        $lowerPriorityCategories = Categoryblog::where('position', '>=', $categoryblog->position)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategoryblog) {
            $lowerPriorityCategoryblog->position++;
            $lowerPriorityCategoryblog->saveQuietly();
        }
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  \App\Categoryblog  $category
     * @return void
     */
    public function updating(Categoryblog $categoryblog)
    {

        if ($categoryblog->isClean('position')) {
            return;
        }

        if (is_null($categoryblog->position)) {
            $categoryblog->position = Categoryblog::max('position');
        }

        if ($categoryblog->getOriginal('position') > $categoryblog->position) {
            $positionRange = [
                $categoryblog->position, $categoryblog->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $categoryblog->getOriginal('position'), $categoryblog->position,
            ];
        }

        $lowerPriorityCategories = Categoryblog::where('id', '!=', $categoryblog->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategoryblog) {
            if ($categoryblog->getOriginal('position') < $categoryblog->position) {
                $lowerPriorityCategoryblog->position--;
            } else {
                $lowerPriorityCategoryblog->position++;
            }
            $lowerPriorityCategoryblog->saveQuietly();
        }
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Categoryblog  $category
     * @return void
     */
    public function deleted(Categoryblog $categoryblog)
    {
        $lowerPriorityCategories = Categoryblog::where('position', '>', $categoryblog->position)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategoryblog) {
            $lowerPriorityCategoryblog->position--;
            $lowerPriorityCategoryblog->saveQuietly();
        }
    }
}
