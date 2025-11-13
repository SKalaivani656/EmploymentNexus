<?php

namespace App\Observers\Job;

use App\Models\Admin\Job\Jobmaster\Branchjob;

class BranchjobpostionObserver
{
    /**
     * Handle the category "creating" event.
     *
     * @param  \App\Job\Branchjob  $category
     * @return void
     */
    public function creating(Branchjob $branchjob)
    {

        if (is_null($branchjob->position)) {
            $branchjob->position = Branchjob::max('position') + 1;
            return;
        }

        $lowerPriorityBranch = Branchjob::where('position', '>=', $branchjob->position)
            ->get();

        foreach ($lowerPriorityBranch as $lowerPriorityBranchjob) {
            $lowerPriorityBranchjob->position++;
            $lowerPriorityBranchjob->saveQuietly();
        }
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  \App\Job\Branchjob  $category
     * @return void
     */
    public function updating(Branchjob $branchjob)
    {

        if ($branchjob->isClean('position')) {
            return;
        }

        if (is_null($branchjob->position)) {
            $branchjob->position = Branchjob::max('position');
        }

        if ($branchjob->getOriginal('position') > $branchjob->position) {
            $positionRange = [
                $branchjob->position, $branchjob->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $branchjob->getOriginal('position'), $branchjob->position,
            ];
        }

        $lowerPriorityBranch = Branchjob::where('id', '!=', $branchjob->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityBranch as $lowerPriorityBranchjob) {
            if ($branchjob->getOriginal('position') < $branchjob->position) {
                $lowerPriorityBranchjob->position--;
            } else {
                $lowerPriorityBranchjob->position++;
            }
            $lowerPriorityBranchjob->saveQuietly();
        }
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Job\Branchjob  $category
     * @return void
     */
    public function deleted(Branchjob $branchjob)
    {
        $lowerPriorityBranch = Branchjob::where('position', '>', $branchjob->position)
            ->get();

        foreach ($lowerPriorityBranch as $lowerPriorityBranchjob) {
            $lowerPriorityBranchjob->position--;
            $lowerPriorityBranchjob->saveQuietly();
        }
    }
}
