<?php

namespace App\Exports;

use App\Models\Goods;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class GoodsExport implements FromCollection
{
    use Exportable;
    protected $data;

    private $fileName;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Goods::all();
    }

    /**
     * @return array
     */
    public function array():array
    {
        return $this->data;

    }

    /**
     * @param mixed $row
     * @return array
     */
    public function map($row): array
    {
        return [
            $row['id'],
            $row['name'],
            $row['sub_name'],
            $row['price'],
            $row['cost_price'],
            $row['stock'],
            $row['sort'],
            $row['is_show'],
            $row['created_at'],
        ];
    }

    /**
     * @return array
     */
    public
    function headings(): array
    {
        return [
            'ID',
            'NAME',
            'SUB_NAME',
            'PRICE',
            'COST_PRICE',
            'STOCK',
            'SORT',
            'IS_SHOW',
            'CREATED_AT',
        ];
    }
}
