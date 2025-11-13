<?php

namespace App\Observers\Job;

use App\Models\Admin\Job\Jobmaster\Designationjob;

class DesignationjobpositionObserver
{
    /**
     * Handle the category "creating" event.
     *
     * @param  \App\Job\ Designationjob  $category
     * @return void
     */
    public function creating(Designationjob $designation)
    {

        if (is_null($designation->position)) {
            $designation->position =  Designationjob::max('position') + 1;
            return;
        }

        $lowerPriorityCourse =  Designationjob::where('position', '>=', $designation->position)
            ->get();

        foreach ($lowerPriorityCourse as $lowerPrioritydesignation) {
            $lowerPrioritydesignation->position++;
            $lowerPrioritydesignation->saveQuietly();
        }
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  \App\Job\designation  $category
     * @return void
     */
    public function updating(Designationjob $designation)
    {

        if ($designation->isClean('position')) {
            return;
        }

        if (is_null($designation->position)) {
            $designation->position =  Designationjob::max('position');
        }

        if ($designation->getOriginal('position') > $designation->position) {
            $positionRange = [
                $designation->position, $designation->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $designation->getOriginal('position'), $designation->position,
            ];
        }

        $lowerPriorityCourse =  Designationjob::where('id', '!=', $designation->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityCourse as $lowerPrioritydesignation) {
            if ($designation->getOriginal('position') < $designation->position) {
                $lowerPrioritydesignation->position--;
            } else {
                $lowerPrioritydesignation->position++;
            }
            $lowerPrioritydesignation->saveQuietly();
        }
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Job\designation  $category
     * @return void
     */
    public function deleted(Designationjob $designation)
    {
        $lowerPriorityCourse =  Designationjob::where('position', '>', $designation->position)
            ->get();

        foreach ($lowerPriorityCourse as $lowerPrioritydesignation) {
            $lowerPrioritydesignation->position--;
            $lowerPrioritydesignation->saveQuietly();
        }
    }
}
