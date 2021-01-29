<?php

namespace App\Traits;

/**
 * Item Unique Id trait
 */
trait HasItemUniqueId
{
    /**
     * Bootable trait for item_unique_id
     *
     * @return void
     */
    protected static function bootHasItemUniqueId()
    {
        static::creating(function ($model) {
            $count = static::count();

            $defaultPadLeft = 6;

            do {
                $numlength = strlen((string) $count);

                if ($numlength >= 6 && preg_match("/^[9]+$/i", $count)) {

                    $defaultPadLeft = $numlength + 1;

                    $count = 0;
                }

                $count++;

                $item_unique_id = str_pad($count, $defaultPadLeft, "0", STR_PAD_LEFT);
            } while (static::where('item_unique_id', $item_unique_id)->exists());

            $text = (string) $item_unique_id; // convert into a string

            $arr = str_split($text, "3"); // break string in 3 character sets

            $formatted_item_unique_id = implode("-", $arr);  // implode array with comma

            $model->item_unique_id = $formatted_item_unique_id;
        });
    }
}
