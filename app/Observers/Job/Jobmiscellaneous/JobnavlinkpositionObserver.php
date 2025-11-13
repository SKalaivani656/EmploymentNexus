<?php

namespace App\Observers\Job\Jobmiscellaneous;

use App\Models\Admin\Job\Jobmiscellaneous\Jobnavlink;

class JobnavlinkpositionObserver
{
    /**
     * Handle the category "creating" event.
     *
     * @param  \App\Job\Jobnavlink  $category
     * @return void
     */
    public function creating(Jobnavlink $jobnavlink)
    {

        if (is_null($jobnavlink->position)) {
            $jobnavlink->position = Jobnavlink::max('position') + 1;
            return;
        }

        $lowerPriorityJobnavlink = Jobnavlink::where('position', '>=', $jobnavlink->position)
            ->get();

        foreach ($lowerPriorityJobnavlink as $lowerPriorityJobnavlink) {
            $lowerPriorityJobnavlink->position++;
            $lowerPriorityJobnavlink->saveQuietly();
        }
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  \App\Job\Jobnavlink  $category
     * @return void
     */
    public function updating(Jobnavlink $jobnavlink)
    {

        if ($jobnavlink->isClean('position')) {
            return;
        }

        if (is_null($jobnavlink->position)) {
            $jobnavlink->position = Jobnavlink::max('position');
        }

        if ($jobnavlink->getOriginal('position') > $jobnavlink->position) {
            $positionRange = [
                $jobnavlink->position, $jobnavlink->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $jobnavlink->getOriginal('position'), $jobnavlink->position,
            ];
        }

        $lowerPriorityJobnavlink = Jobnavlink::where('id', '!=', $jobnavlink->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityJobnavlink as $lowerPriorityJobnavlink) {
            if ($Jobnavlink->getOriginal('position') < $Jobnavlink->position) {
                $lowerPriorityJobnavlink->position--;
            } else {
                $lowerPriorityJobnavlink->position++;
            }
            $lowerPriorityJobnavlink->saveQuietly();
        }
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Job\jobnavlink  $category
     * @return void
     */
    public function deleted(Jobnavlink $jobnavlink)
    {
        $lowerPriorityJobnavlink = Jobnavlink::where('position', '>', $jobnavlink->position)
            ->get();

        foreach ($lowerPriorityJobnavlink as $lowerPriorityJobnavlink) {
            $lowerPriorityJobnavlink->position--;
            $lowerPriorityJobnavlink->saveQuietly();
        }
    }
}
