<?php

namespace App\Exports;

use App\Services\MainCalculation;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ShareInternalDonatedItemExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting
{
    use Exportable;

    protected $query, $mainCalculation;

    public function __construct($query)
    {
        $this->query = $query;
        $this->mainCalculation = new MainCalculation;
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
    <th>နာမည်</th>
    <th>ပစ္စည်း အမည်</th>
    <th>ပမာဏ</th>
    */
    public function map($shareInternalDonatedItem): array
    {
        $result = $this->mainCalculation->changeSacketsToFormat($shareInternalDonatedItem->itemSubType->id, $shareInternalDonatedItem->sacket_qty);

        return [
            $shareInternalDonatedItem->date,
            $shareInternalDonatedItem->requestable->name,
            $shareInternalDonatedItem->itemSubType->name,
            // $shareInternalDonatedItem->package_qty . ' ' . $shareInternalDonatedItem->itemSubType->unit->package_unit . ' / ' . $shareInternalDonatedItem->sacket_qty . ' ' . $shareInternalDonatedItem->itemSubType->unit->loose_unit,
            $result['text']
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
            "နာမည်",
            "ပစ္စည်း အမည်",
            "ပမာဏ"
        ];
    }
}
