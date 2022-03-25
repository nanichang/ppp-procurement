<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

use App\AdvertLot;

class ImportTenderDocumentInHouse implements WithMappedCells, ToCollection, WithCalculatedFormulas
{
    protected $position;
    protected $advertLot;

    public function __construct($position, $advertLot)
    {
        $this->position = $position;
        $this->advertLot = $advertLot;
    }

    public function mapping(): array
    {
        return [
            'inhouse_bid_amount'  => $this->position,
        ];
    }


    /**
    * @param Model $collection
    */
    public function collection(Collection $row)
    {
        // dd((float)$row['inhouse_bid_amount']);
        return $this->advertLot->inhouse_bid_amount = (float)$row['inhouse_bid_amount'];
    
    }
}
