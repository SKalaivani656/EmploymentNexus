<?php

namespace App\Observers\Job;

use App\Models\Admin\Job\Jobmaster\Typejob;

class TypejobpostionObserver
{
    /**
     * Handle the category "creating" event.
     *
     * @param  \App\Job\Typejob  $category
     * @return void
     */
    public function creating(Typejob $typejob)
    {

        if (is_null($typejob->position)) {
            $typejob->position = Typejob::max('position') + 1;
            return;
        }

        $lowerPriorityType = Typejob::where('position', '>=', $typejob->position)
            ->get();

        foreach ($lowerPriorityType as $lowerPriorityTypejob) {
            $lowerPriorityTypejob->position++;
            $lowerPriorityTypejob->saveQuietly();
        }
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  \App\Job\Typejob  $category
     * @return void
     */
    public function updating(Typejob $typejob)
    {

        if ($typejob->isClean('position')) {
            return;
        }

        if (is_null($typejob->position)) {
            $typejob->position = Typejob::max('position');
        }

        if ($typejob->getOriginal('position') > $typejob->position) {
            $positionRange = [
                $typejob->position, $typejob->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $typejob->getOriginal('position'), $typejob->position,
            ];
        }

        $lowerPriorityType = Typejob::where('id', '!=', $typejob->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityType as $lowerPriorityTypejob) {
            if ($typejob->getOriginal('position') < $typejob->position) {
                $lowerPriorityTypejob->position--;
            } else {
                $lowerPriorityTypejob->position++;
            }
            $lowerPriorityTypejob->saveQuietly();
        }
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Job\Typejob  $category
     * @return void
     */
    public function deleted(Typejob $typejob)
    {
        $lowerPriorityType = Typejob::where('position', '>', $typejob->position)
            ->get();

        foreach ($lowerPriorityType as $lowerPriorityTypejob) {
            $lowerPriorityTypejob->position--;
            $lowerPriorityTypejob->saveQuietly();
        }
    }
}
