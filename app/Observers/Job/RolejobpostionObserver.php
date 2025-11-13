<?php

namespace App\Observers\Job;

use App\Models\Admin\Job\Jobmaster\Rolejob;

class RolejobpostionObserver
{
    /**
     * Handle the category "creating" event.
     *
     * @param  \App\Job\Rolejob  $category
     * @return void
     */
    public function creating(Rolejob $rolejob)
    {

        if (is_null($rolejob->position)) {
            $rolejob->position = Rolejob::max('position') + 1;
            return;
        }

        $lowerPriorityRole = Rolejob::where('position', '>=', $rolejob->position)
            ->get();

        foreach ($lowerPriorityRole as $lowerPriorityRolejob) {
            $lowerPriorityRolejob->position++;
            $lowerPriorityRolejob->saveQuietly();
        }
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  \App\Job\Rolejob  $category
     * @return void
     */
    public function updating(Rolejob $rolejob)
    {

        if ($rolejob->isClean('position')) {
            return;
        }

        if (is_null($rolejob->position)) {
            $rolejob->position = Rolejob::max('position');
        }

        if ($rolejob->getOriginal('position') > $rolejob->position) {
            $positionRange = [
                $rolejob->position, $rolejob->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $rolejob->getOriginal('position'), $rolejob->position,
            ];
        }

        $lowerPriorityRole = Rolejob::where('id', '!=', $rolejob->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityRole as $lowerPriorityRolejob) {
            if ($rolejob->getOriginal('position') < $rolejob->position) {
                $lowerPriorityRolejob->position--;
            } else {
                $lowerPriorityRolejob->position++;
            }
            $lowerPriorityRolejob->saveQuietly();
        }
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Job\Rolejob  $category
     * @return void
     */
    public function deleted(Rolejob $rolejob)
    {
        $lowerPriorityRole = Rolejob::where('position', '>', $rolejob->position)
            ->get();

        foreach ($lowerPriorityRole as $lowerPriorityRolejob) {
            $lowerPriorityRolejob->position--;
            $lowerPriorityRolejob->saveQuietly();
        }
    }
}
