<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    function getProperDate($data)
    {
        /*foreach ($data as $item)
        {
            $item->created_at = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('d-m-Y\TH:i:s.uP');
            $item->updated_at = Carbon::createFromFormat('Y-m-d H:i:s', $item->updated_at)->format('d-m-Y\TH:i:s.uP');
            dump([$item->created_at, $item->updated_at]);
        }*/

        return $data;
    }
}
