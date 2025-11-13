<?php

namespace App\Observers\Job;

use App\Models\Admin\Job\Jobmaster\Categoryjob;

class CategoryjobpostionObserver
{
    /**
     * Handle the category "creating" event.
     *
     * @param  \App\Job\Categoryjob  $category
     * @return void
     */
    public function creating(Categoryjob $categoryjob)
    {

        if (is_null($categoryjob->position)) {
            $categoryjob->position = Categoryjob::max('position') + 1;
            return;
        }

        $lowerPriorityCategory = Categoryjob::where('position', '>=', $categoryjob->position)
            ->get();

        foreach ($lowerPriorityCategory as $lowerPriorityCategoryjob) {
            $lowerPriorityCategoryjob->position++;
            $lowerPriorityCategoryjob->saveQuietly();
        }
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  \App\Job\Categoryjob  $category
     * @return void
     */
    public function updating(Categoryjob $categoryjob)
    {

        if ($categoryjob->isClean('position')) {
            return;
        }

        if (is_null($categoryjob->position)) {
            $categoryjob->position = Categoryjob::max('position');
        }

        if ($categoryjob->getOriginal('position') > $categoryjob->position) {
            $positionRange = [
                $categoryjob->position, $categoryjob->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $categoryjob->getOriginal('position'), $categoryjob->position,
            ];
        }

        $lowerPriorityCategory = Categoryjob::where('id', '!=', $categoryjob->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityCategory as $lowerPriorityCategoryjob) {
            if ($categoryjob->getOriginal('position') < $categoryjob->position) {
                $lowerPriorityCategoryjob->position--;
            } else {
                $lowerPriorityCategoryjob->position++;
            }
            $lowerPriorityCategoryjob->saveQuietly();
        }
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Job\Categoryjob  $category
     * @return void
     */
    public function deleted(Categoryjob $categoryjob)
    {
        $lowerPriorityCategory = Categoryjob::where('position', '>', $categoryjob->position)
            ->get();

        foreach ($lowerPriorityCategory as $lowerPriorityCategoryjob) {
            $lowerPriorityCategoryjob->position--;
            $lowerPriorityCategoryjob->saveQuietly();
        }
    }
}
