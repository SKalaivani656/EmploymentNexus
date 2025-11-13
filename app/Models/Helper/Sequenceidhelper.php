<?php

namespace App\Models\Helper;

use Illuminate\Database\Eloquent\Model;

class Sequenceidhelper extends Model
{
    public static function getNextSequenceId($digit, $name, $model)
    {
        $object = $model::withTrashed()
            ->orderBy('created_at', 'desc')
            ->orderBy('sequence_id', 'desc')
            ->first();

        $lastId = (!$object) ? 0 : $object->sequence_id;

        return array(
            'uniqid' => $name . '-' . sprintf('%0' . $digit . 'd', intval($lastId) + 1),
            'user_code' => sprintf('%0' . $digit . 'd', intval($lastId) + 1),
            'sequence_id' => $lastId + 1,
            'sys_id' => md5(uniqid(rand(), true)),
        );
    }

    public static function getNextSequenceIdTwo($digit, $name, $model)
    {
        $object = $model::withTrashed()
            ->orderBy('sequence_id', 'desc')
            ->first();

        $lastId = (!$object) ? 0 : $object->sequence_id;

        return array(
            'uniqid' => $name . '-' . sprintf('%0' . $digit . 'd', intval($lastId) + 1),
            'sequence_id' => $lastId + 1,
            'sys_id' => md5(uniqid(rand(), true)),
        );
    }

}
