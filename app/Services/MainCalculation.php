<?php

namespace App\Services;

use App\ItemSubType;

class MainCalculation
{
    /**
     * $iteSubType = App\ItemSubType Model
     * 
     */
    public function calculateOnInternalDonatedItems($itemSubType)
    {
        $leftSackets = $this->totalLeftSackets($itemSubType);

        $leftPackage = $leftSackets / $itemSubType->sacket_per_package;

        $leftLoose = $leftSackets % $itemSubType->sacket_per_package;

        $text = floor($leftPackage) . ' ' . $itemSubType->unit->package_unit . ' ' . $leftLoose . ' ' . $itemSubType->unit->loose_unit;

        return [
            'left_packages' => $leftPackage,
            'left_sackets' => $leftLoose,
            'text' => $text
        ];
    }

    public function totalLeftSackets($itemSubType)
    {
        $sharedsackets = $itemSubType->sharedInternalDonatedItems()
            ->where('office_id', auth()->user()->office_id)
            ->get()
            ->sum(function ($item) {
                return $item->sacket_qty;
            });

        $totalSackets = $itemSubType->internalDonatedItems()
            ->where('office_id', auth()->user()->office_id)
            ->confirmed()
            ->get()->sum(function ($item) use ($itemSubType) {
                return ($item->package_qty * $itemSubType->sacket_per_package) + $item->sacket_qty;
            });

        $leftSackets = $totalSackets - $sharedsackets;

        return $leftSackets;
    }

    public function canShareThisAmountForUpdate($item_sub_type_id, $package_qty, $sacket_qty, $shareInternalDonatedItem)
    {
        $itemSubType = ItemSubType::find($item_sub_type_id);

        $leftSackets = $this->totalLeftSackets($itemSubType);

        $totalLeftSackets = $leftSackets + $shareInternalDonatedItem->sacket_qty;

        $allRequestedSackets = $this->changeAllToSackets($item_sub_type_id, $package_qty, $sacket_qty);

        return  $allRequestedSackets <= $totalLeftSackets;
    }

    public function canShareThisAmount($item_sub_type_id, $package_qty, $sacket_qty)
    {
        $itemSubType = ItemSubType::find($item_sub_type_id);

        $allRequestedSackets = $this->changeAllToSackets($item_sub_type_id, $package_qty, $sacket_qty);

        $leftSackets = $this->totalLeftSackets($itemSubType);

        return  $allRequestedSackets <= $leftSackets;
    }

    public function changeAllToSackets($item_sub_type_id, $package_qty, $sacket_qty)
    {
        $itemSubType = ItemSubType::find($item_sub_type_id);

        return ($package_qty * $itemSubType->sacket_per_package) + $sacket_qty;
    }

    public function seperatePackageSackets($item_sub_type_id, $sacket_qty)
    {
        $itemSubType = ItemSubType::find($item_sub_type_id);

        $leftPackage = $sacket_qty / $itemSubType->sacket_per_package;

        $leftLoose = $sacket_qty % $itemSubType->sacket_per_package;

        $text = floor($leftPackage) . ' ' . $itemSubType->unit->package_unit . ' ' . $leftLoose . ' ' . $itemSubType->unit->loose_unit;

        return [
            'package_qty' => floor($leftPackage),
            'sacket_qty' => $leftLoose,
            'text' => $text
        ];
    }

    public function changeSacketsToFormat($item_sub_type_id, $sacket_qty)
    {
        $itemSubType = ItemSubType::find($item_sub_type_id);

        if ($sacket_qty >= $itemSubType->sacket_per_package) {
            $package = $sacket_qty / $itemSubType->sacket_per_package;
            $leftLoose = $sacket_qty % $itemSubType->sacket_per_package;
        } else {
            $package = 0;
            $leftLoose = $sacket_qty;
        }

        $text = floor($package) . ' ' . $itemSubType->unit->package_unit . ' ' . $leftLoose . ' ' . $itemSubType->unit->loose_unit;

        return [
            'package_qty' => floor($package),
            'sacket_qty' => $leftLoose,
            'text' => $text
        ];
    }
}
