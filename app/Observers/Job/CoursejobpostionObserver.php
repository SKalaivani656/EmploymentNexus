<?php

namespace App\Observers\Job;

use App\Models\Admin\Job\Jobmaster\Coursejob;

class CoursejobpostionObserver
{
    /**
     * Handle the category "creating" event.
     *
     * @param  \App\Job\Coursejob  $category
     * @return void
     */
    public function creating(Coursejob $coursejob)
    {

        if (is_null($coursejob->position)) {
            $coursejob->position = Coursejob::max('position') + 1;
            return;
        }

        $lowerPriorityCourse = Coursejob::where('position', '>=', $coursejob->position)
            ->get();

        foreach ($lowerPriorityCourse as $lowerPriorityCoursejob) {
            $lowerPriorityCoursejob->position++;
            $lowerPriorityCoursejob->saveQuietly();
        }
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  \App\Job\Coursejob  $category
     * @return void
     */
    public function updating(Coursejob $coursejob)
    {

        if ($coursejob->isClean('position')) {
            return;
        }

        if (is_null($coursejob->position)) {
            $coursejob->position = Coursejob::max('position');
        }

        if ($coursejob->getOriginal('position') > $coursejob->position) {
            $positionRange = [
                $coursejob->position, $coursejob->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $coursejob->getOriginal('position'), $coursejob->position,
            ];
        }

        $lowerPriorityCourse = Coursejob::where('id', '!=', $coursejob->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityCourse as $lowerPriorityCoursejob) {
            if ($coursejob->getOriginal('position') < $coursejob->position) {
                $lowerPriorityCoursejob->position--;
            } else {
                $lowerPriorityCoursejob->position++;
            }
            $lowerPriorityCoursejob->saveQuietly();
        }
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Job\Coursejob  $category
     * @return void
     */
    public function deleted(Coursejob $coursejob)
    {
        $lowerPriorityCourse = Coursejob::where('position', '>', $coursejob->position)
            ->get();

        foreach ($lowerPriorityCourse as $lowerPriorityCoursejob) {
            $lowerPriorityCoursejob->position--;
            $lowerPriorityCoursejob->saveQuietly();
        }
    }
}
