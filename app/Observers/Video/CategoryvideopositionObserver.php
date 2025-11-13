<?php

namespace App\Observers\Video;

use App\Models\Admin\Video\Categoryvideo;

class CategoryvideopositionObserver
{
    /**CategoryvideopositionObserver
     * Handle the category "creating" event.
     *
     * @param  \App\Categoryvideo  $category
     * @return void
     */
    public function creating(Categoryvideo $categoryvideo)
    {

        if (is_null($categoryvideo->position)) {
            $categoryvideo->position = Categoryvideo::max('position') + 1;
            return;
        }

        $lowerPriorityCategories = Categoryvideo::where('position', '>=', $categoryvideo->position)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategoryblog) {
            $lowerPriorityCategoryblog->position++;
            $lowerPriorityCategoryblog->saveQuietly();
        }
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  \App\Categoryvideo  $category
     * @return void
     */
    public function updating(Categoryvideo $categoryvideo)
    {

        if ($categoryvideo->isClean('position')) {
            return;
        }

        if (is_null($categoryvideo->position)) {
            $categoryvideo->position = Categoryvideo::max('position');
        }

        if ($categoryvideo->getOriginal('position') > $categoryvideo->position) {
            $positionRange = [
                $categoryvideo->position, $categoryvideo->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $categoryvideo->getOriginal('position'), $categoryvideo->position,
            ];
        }

        $lowerPriorityCategories = Categoryvideo::where('id', '!=', $categoryvideo->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategoryblog) {
            if ($categoryvideo->getOriginal('position') < $categoryvideo->position) {
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
     * @param  \App\Categoryvideo  $category
     * @return void
     */
    public function deleted(Categoryvideo $categoryvideo)
    {
        $lowerPriorityCategories = Categoryvideo::where('position', '>', $categoryvideo->position)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategoryblog) {
            $lowerPriorityCategoryblog->position--;
            $lowerPriorityCategoryblog->saveQuietly();
        }
    }
}
