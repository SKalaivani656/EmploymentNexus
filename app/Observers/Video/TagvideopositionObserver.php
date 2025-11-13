<?php

namespace App\Observers\Video;

use App\Models\Admin\Video\Tagvideo;

class TagvideopositionObserver
{
    /**
     * Handle the tag "creating" event.
     *
     * @param  \App\Tagvideo  $tag
     * @return void
     */
    public function creating(Tagvideo $tagvideo)
    {

        if (is_null($tagvideo->position)) {
            $tagvideo->position = Tagvideo::max('position') + 1;
            return;
        }

        $lowerPriorityCategories = Tagvideo::where('position', '>=', $tagvideo->position)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategoryblog) {
            $lowerPriorityCategoryblog->position++;
            $lowerPriorityCategoryblog->saveQuietly();
        }
    }

    /**
     * Handle the tag "updating" event.
     *
     * @param  \App\Tagvideo  $tag
     * @return void
     */
    public function updating(Tagvideo $tagvideo)
    {

        if ($tagvideo->isClean('position')) {
            return;
        }

        if (is_null($tagvideo->position)) {
            $tagvideo->position = Tagvideo::max('position');
        }

        if ($tagvideo->getOriginal('position') > $tagvideo->position) {
            $positionRange = [
                $tagvideo->position, $tagvideo->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $tagvideo->getOriginal('position'), $tagvideo->position,
            ];
        }

        $lowerPriorityCategories = Tagvideo::where('id', '!=', $tagvideo->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategoryblog) {
            if ($tagvideo->getOriginal('position') < $tagvideo->position) {
                $lowerPriorityCategoryblog->position--;
            } else {
                $lowerPriorityCategoryblog->position++;
            }
            $lowerPriorityCategoryblog->saveQuietly();
        }
    }

    /**
     * Handle the tag "deleted" event.
     *
     * @param  \App\Tagvideo  $tag
     * @return void
     */
    public function deleted(Tagvideo $tagvideo)
    {
        $lowerPriorityCategories = Tagvideo::where('position', '>', $tagvideo->position)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategoryblog) {
            $lowerPriorityCategoryblog->position--;
            $lowerPriorityCategoryblog->saveQuietly();
        }
    }
}
