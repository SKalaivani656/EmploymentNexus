<?php

namespace App\Observers\Video;

use App\Models\Admin\Video\Postvideo;

class PostvideopositionObserver
{
    /**
     * Handle the post "creating" event.
     *
     * @param  \App\Postvideo  $post
     * @return void
     */
    public function creating(Postvideo $postvideo)
    {

        if (is_null($postvideo->position)) {
            $postvideo->position = Postvideo::max('position') + 1;
            return;
        }

        $lowerPriorityCategories = Postvideo::where('position', '>=', $postvideo->position)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategoryblog) {
            $lowerPriorityCategoryblog->position++;
            $lowerPriorityCategoryblog->saveQuietly();
        }
    }

    /**
     * Handle the post "updating" event.
     *
     * @param  \App\Postvideo  $post
     * @return void
     */
    public function updating(Postvideo $postvideo)
    {

        if ($postvideo->isClean('position')) {
            return;
        }

        if (is_null($postvideo->position)) {
            $postvideo->position = Postvideo::max('position');
        }

        if ($postvideo->getOriginal('position') > $postvideo->position) {
            $positionRange = [
                $postvideo->position, $postvideo->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $postvideo->getOriginal('position'), $postvideo->position,
            ];
        }

        $lowerPriorityCategories = Postvideo::where('id', '!=', $postvideo->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategoryblog) {
            if ($postvideo->getOriginal('position') < $postvideo->position) {
                $lowerPriorityCategoryblog->position--;
            } else {
                $lowerPriorityCategoryblog->position++;
            }
            $lowerPriorityCategoryblog->saveQuietly();
        }
    }

    /**
     * Handle the post "deleted" event.
     *
     * @param  \App\Postvideo  $post
     * @return void
     */
    public function deleted(Postvideo $postvideo)
    {
        $lowerPriorityCategories = Postvideo::where('position', '>', $postvideo->position)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategoryblog) {
            $lowerPriorityCategoryblog->position--;
            $lowerPriorityCategoryblog->saveQuietly();
        }
    }
}
