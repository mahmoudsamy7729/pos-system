<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;



class PartialStockCountExport implements FromQuery , WithMapping , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    protected  $warehouse_id;
    protected  $categories_id;
    public function __construct($warehouse , $categories)
    {
        $this->categories_id   = $categories;
        $this->warehouse_id = $warehouse;
    }

    public function query()
    {
        return Item::query()->whereIn('category_id',$this->categories_id);
    }

    public function map($item): array
    {
        return [
            $item->name,
            $item->barcode,
            $item->warehouse_quantity->where('warehouse_id', '=', $this->warehouse_id)->first()->quantity,
        ];
    }
    public function headings(): array
    {
        return [
            'Product Name',
            'Product Barcode',
            'Expected',
            'Counted',
        ];
    }
}
