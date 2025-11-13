<?php

namespace App\Observers\Exam\Master;

use App\Models\Admin\Exam\Master\Competitiveexam;

class CompetitiveexampostionObserver
{
    /**
     * Handle the category "creating" event.
     *
     * @param  \App\Job\Competitiveexam  $category
     * @return void
     */
    public function creating(Competitiveexam $competitiveexam)
    {

        if (is_null($competitiveexam->position)) {
            $competitiveexam->position = Competitiveexam::max('position') + 1;
            return;
        }

        $lowerPriorityCategory = Competitiveexam::where('position', '>=', $competitiveexam->position)
            ->get();

        foreach ($lowerPriorityCategory as $lowerPriorityCompetitiveexam) {
            $lowerPriorityCompetitiveexam->position++;
            $lowerPriorityCompetitiveexam->saveQuietly();
        }
    }

    /**
     * Handle the category "updating" event.
     *
     * @param  \App\Job\Competitiveexam  $category
     * @return void
     */
    public function updating(Competitiveexam $competitiveexam)
    {

        if ($competitiveexam->isClean('position')) {
            return;
        }

        if (is_null($competitiveexam->position)) {
            $competitiveexam->position = Competitiveexam::max('position');
        }

        if ($competitiveexam->getOriginal('position') > $competitiveexam->position) {
            $positionRange = [
                $competitiveexam->position, $competitiveexam->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $competitiveexam->getOriginal('position'), $competitiveexam->position,
            ];
        }

        $lowerPriorityCategory = Competitiveexam::where('id', '!=', $competitiveexam->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityCategory as $lowerPriorityCompetitiveexam) {
            if ($competitiveexam->getOriginal('position') < $competitiveexam->position) {
                $lowerPriorityCompetitiveexam->position--;
            } else {
                $lowerPriorityCompetitiveexam->position++;
            }
            $lowerPriorityCompetitiveexam->saveQuietly();
        }
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Job\Competitiveexam  $category
     * @return void
     */
    public function deleted(Competitiveexam $competitiveexam)
    {
        $lowerPriorityCategory = Competitiveexam::where('position', '>', $competitiveexam->position)
            ->get();

        foreach ($lowerPriorityCategory as $lowerPriorityCompetitiveexam) {
            $lowerPriorityCompetitiveexam->position--;
            $lowerPriorityCompetitiveexam->saveQuietly();
        }
    }
}
