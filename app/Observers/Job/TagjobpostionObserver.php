<?php

namespace App\Observers\Job;

use App\Models\Admin\Job\Jobmaster\Tagjob;

class TagjobpostionObserver
{
    /**
     * Handle the category "creating" event.
     *
     * @param  \App\Job\Tagjob  $category
     * @return void
     */
    public function creating(Tagjob $tagjob)
    {

        if (is_null($tagjob->position)) {
            $tagjob->position = Tagjob::max('position') + 1;
            return;
        }

        $lowerPriorityTag = Tagjob::where('position', '>=', $tagjob->position)
            ->get();

        foreach ($lowerPriorityTag as $lowerPriorityTagjob) {
            $lowerPriorityTagjob->position++;
            $lowerPriorityTagjob->saveQuietly();
        }
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  \App\Job\Tagjob  $category
     * @return void
     */
    public function updating(Tagjob $tagjob)
    {

        if ($tagjob->isClean('position')) {
            return;
        }

        if (is_null($tagjob->position)) {
            $tagjob->position = Tagjob::max('position');
        }

        if ($tagjob->getOriginal('position') > $tagjob->position) {
            $positionRange = [
                $tagjob->position, $tagjob->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $tagjob->getOriginal('position'), $tagjob->position,
            ];
        }

        $lowerPriorityTag = Tagjob::where('id', '!=', $tagjob->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityTag as $lowerPriorityTagjob) {
            if ($tagjob->getOriginal('position') < $tagjob->position) {
                $lowerPriorityTagjob->position--;
            } else {
                $lowerPriorityTagjob->position++;
            }
            $lowerPriorityTagjob->saveQuietly();
        }
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Job\Tagjob  $category
     * @return void
     */
    public function deleted(Tagjob $tagjob)
    {
        $lowerPriorityTag = Tagjob::where('position', '>', $tagjob->position)
            ->get();

        foreach ($lowerPriorityTag as $lowerPriorityTagjob) {
            $lowerPriorityTagjob->position--;
            $lowerPriorityTagjob->saveQuietly();
        }
    }
}
