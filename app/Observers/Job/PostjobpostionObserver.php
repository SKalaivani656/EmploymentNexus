<?php

namespace App\Observers\Job;

use App\Models\Admin\Job\Jobpost\Postjob;

class PostjobpostionObserver
{
    /**
     * Handle the category "creating" event.
     *
     * @param  \App\Job\Postjob  $category
     * @return void
     */
    public function creating(Postjob $postjob)
    {

        if (is_null($postjob->position)) {
            $postjob->position = Postjob::max('position') + 1;
            return;
        }

        $lowerPriorityPost = Postjob::where('position', '>=', $postjob->position)
            ->get();

        foreach ($lowerPriorityPost as $lowerPriorityPostjob) {
            $lowerPriorityPostjob->position++;
            $lowerPriorityPostjob->saveQuietly();
        }
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  \App\Job\Postjob  $category
     * @return void
     */
    public function updating(Postjob $postjob)
    {

        if ($postjob->isClean('position')) {
            return;
        }

        if (is_null($postjob->position)) {
            $postjob->position = Postjob::max('position');
        }

        if ($postjob->getOriginal('position') > $postjob->position) {
            $positionRange = [
                $postjob->position, $postjob->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $postjob->getOriginal('position'), $postjob->position,
            ];
        }

        $lowerPriorityPost = Postjob::where('id', '!=', $postjob->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityPost as $lowerPriorityPostjob) {
            if ($postjob->getOriginal('position') < $postjob->position) {
                $lowerPriorityPostjob->position--;
            } else {
                $lowerPriorityPostjob->position++;
            }
            $lowerPriorityPostjob->saveQuietly();
        }
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Job\Postjob  $category
     * @return void
     */
    public function deleted(Postjob $postjob)
    {
        $lowerPriorityPost = Postjob::where('position', '>', $postjob->position)
            ->get();

        foreach ($lowerPriorityPost as $lowerPriorityPostjob) {
            $lowerPriorityPostjob->position--;
            $lowerPriorityPostjob->saveQuietly();
        }
    }
}
