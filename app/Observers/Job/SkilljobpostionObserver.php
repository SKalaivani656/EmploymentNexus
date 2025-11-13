<?php

namespace App\Observers\Job;

use App\Models\Admin\Job\Jobmaster\Skilljob;

class SkilljobpostionObserver
{
    /**
     * Handle the category "creating" event.
     *
     * @param  \App\Job\Skilljob  $category
     * @return void
     */
    public function creating(Skilljob $skilljob)
    {

        if (is_null($skilljob->position)) {
            $skilljob->position = Skilljob::max('position') + 1;
            return;
        }

        $lowerPrioritySkill = Skilljob::where('position', '>=', $skilljob->position)
            ->get();

        foreach ($lowerPrioritySkill as $lowerPrioritySkilljob) {
            $lowerPrioritySkilljob->position++;
            $lowerPrioritySkilljob->saveQuietly();
        }
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  \App\Job\Skilljob  $category
     * @return void
     */
    public function updating(Skilljob $skilljob)
    {

        if ($skilljob->isClean('position')) {
            return;
        }

        if (is_null($skilljob->position)) {
            $skilljob->position = Skilljob::max('position');
        }

        if ($skilljob->getOriginal('position') > $skilljob->position) {
            $positionRange = [
                $skilljob->position, $skilljob->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $skilljob->getOriginal('position'), $skilljob->position,
            ];
        }

        $lowerPrioritySkill = Skilljob::where('id', '!=', $skilljob->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPrioritySkill as $lowerPrioritySkilljob) {
            if ($skilljob->getOriginal('position') < $skilljob->position) {
                $lowerPrioritySkilljob->position--;
            } else {
                $lowerPrioritySkilljob->position++;
            }
            $lowerPrioritySkilljob->saveQuietly();
        }
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Job\Skilljob  $category
     * @return void
     */
    public function deleted(Skilljob $skilljob)
    {
        $lowerPrioritySkill = Skilljob::where('position', '>', $skilljob->position)
            ->get();

        foreach ($lowerPrioritySkill as $lowerPrioritySkilljob) {
            $lowerPrioritySkilljob->position--;
            $lowerPrioritySkilljob->saveQuietly();
        }
    }
}
