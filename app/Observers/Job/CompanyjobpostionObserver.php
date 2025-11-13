<?php

namespace App\Observers\Job;

use App\Models\Admin\Job\Jobmaster\Companyjob;

class CompanyjobpostionObserver
{
    /**
     * Handle the category "creating" event.
     *
     * @param  \App\Job\Companyjob  $category
     * @return void
     */
    public function creating(Companyjob $companyjob)
    {

        if (is_null($companyjob->position)) {
            $companyjob->position = Companyjob::max('position') + 1;
            return;
        }

        $lowerPriorityCompany = Companyjob::where('position', '>=', $companyjob->position)
            ->get();

        foreach ($lowerPriorityCompany as $lowerPriorityCompanyjob) {
            $lowerPriorityCompanyjob->position++;
            $lowerPriorityCompanyjob->saveQuietly();
        }
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  \App\Job\Companyjob  $category
     * @return void
     */
    public function updating(Companyjob $companyjob)
    {

        if ($companyjob->isClean('position')) {
            return;
        }

        if (is_null($companyjob->position)) {
            $companyjob->position = Companyjob::max('position');
        }

        if ($companyjob->getOriginal('position') > $companyjob->position) {
            $positionRange = [
                $companyjob->position, $companyjob->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $companyjob->getOriginal('position'), $companyjob->position,
            ];
        }

        $lowerPriorityCompany = Companyjob::where('id', '!=', $companyjob->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityCompany as $lowerPriorityCompanyjob) {
            if ($companyjob->getOriginal('position') < $companyjob->position) {
                $lowerPriorityCompanyjob->position--;
            } else {
                $lowerPriorityCompanyjob->position++;
            }
            $lowerPriorityCompanyjob->saveQuietly();
        }
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Job\Companyjob  $category
     * @return void
     */
    public function deleted(Companyjob $companyjob)
    {
        $lowerPriorityCompany = Companyjob::where('position', '>', $companyjob->position)
            ->get();

        foreach ($lowerPriorityCompany as $lowerPriorityCompanyjob) {
            $lowerPriorityCompanyjob->position--;
            $lowerPriorityCompanyjob->saveQuietly();
        }
    }
}
