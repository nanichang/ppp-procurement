<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class ImportContractorTenderDocument implements WithMappedCells, ToCollection, WithCalculatedFormulas
{
    protected $position;
    protected $sale;

    public function __construct($position, $sale)
    {
        $this->position = $position;
        $this->sale = $sale;
    }

    public function mapping(): array
    {
        return [
            'contractor_bid_amount'  => $this->position,
        ];
    }


    /**
    * @param Model $collection
    */
    public function collection(Collection $row)
    {
        return $this->sale->contractor_bid_amount = (float)$row['contractor_bid_amount'];
    }
}
