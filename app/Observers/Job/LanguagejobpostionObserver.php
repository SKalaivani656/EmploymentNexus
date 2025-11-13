<?php

namespace App\Observers\Job;

use App\Models\Admin\Job\Jobmaster\Languagejob;

class LanguagejobpostionObserver
{
    /**
     * Handle the category "creating" event.
     *
     * @param  \App\Job\Languagejob  $category
     * @return void
     */
    public function creating(Languagejob $languagejob)
    {

        if (is_null($languagejob->position)) {
            $languagejob->position = Languagejob::max('position') + 1;
            return;
        }

        $lowerPriorityLanguage = Languagejob::where('position', '>=', $languagejob->position)
            ->get();

        foreach ($lowerPriorityLanguage as $lowerPriorityLanguagejob) {
            $lowerPriorityLanguagejob->position++;
            $lowerPriorityLanguagejob->saveQuietly();
        }
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  \App\Job\Languagejob  $category
     * @return void
     */
    public function updating(Languagejob $languagejob)
    {

        if ($languagejob->isClean('position')) {
            return;
        }

        if (is_null($languagejob->position)) {
            $languagejob->position = Languagejob::max('position');
        }

        if ($languagejob->getOriginal('position') > $languagejob->position) {
            $positionRange = [
                $languagejob->position, $languagejob->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $languagejob->getOriginal('position'), $languagejob->position,
            ];
        }

        $lowerPriorityLanguage = Languagejob::where('id', '!=', $languagejob->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityLanguage as $lowerPriorityLanguagejob) {
            if ($languagejob->getOriginal('position') < $languagejob->position) {
                $lowerPriorityLanguagejob->position--;
            } else {
                $lowerPriorityLanguagejob->position++;
            }
            $lowerPriorityLanguagejob->saveQuietly();
        }
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Job\Languagejob  $category
     * @return void
     */
    public function deleted(Languagejob $languagejob)
    {
        $lowerPriorityLanguage = Languagejob::where('position', '>', $languagejob->position)
            ->get();

        foreach ($lowerPriorityLanguage as $lowerPriorityLanguagejob) {
            $lowerPriorityLanguagejob->position--;
            $lowerPriorityLanguagejob->saveQuietly();
        }
    }
}
