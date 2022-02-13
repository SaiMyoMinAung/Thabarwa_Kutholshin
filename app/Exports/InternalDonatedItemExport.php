<?php

namespace App\Exports;

use App\Status\InternalDonatedItemStatus;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class InternalDonatedItemExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting
{
    use Exportable;

    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return $this->query;
    }

    /*
    <th>ရက်စွဲ</th>
    <th>ပစ္စည်း ဝင်လာသည့် နေရာ</th>
    <th>ပစ္စည်း အမည်</th>
    <th>နှုန်းထား</th>
    <th>ပမာဏ</th>
    <th>အခြေအနေ</th>
    */
    public function map($internalDonatedItem): array
    {
        return [
            $internalDonatedItem->date,
            $internalDonatedItem->almsRound->name,
            $internalDonatedItem->itemSubType->name,
            $internalDonatedItem->itemSubType->sacket_per_package,
            $internalDonatedItem->package_qty . ' ' . $internalDonatedItem->itemSubType->unit->package_unit . ' / ' . $internalDonatedItem->sacket_qty . ' ' . $internalDonatedItem->itemSubType->unit->loose_unit,
            InternalDonatedItemStatus::advanceSearch(($internalDonatedItem->status))["label"]
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => '@',
        ];
    }

    public function headings(): array
    {
        return [
            "ရက်စွဲ",
            "ပစ္စည်း ဝင်လာသည့် နေရာ",
            "ပစ္စည်း အမည်",
            "နှုန်းထား",
            "ပမာဏ",
            "အခြေအနေ",
        ];
    }
}
