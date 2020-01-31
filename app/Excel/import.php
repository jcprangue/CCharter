<?php

namespace App\Excel;

use App\charter;
use App\Excel\sheet;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class Import implements WithMultipleSheets 
{
     use WithConditionalSheets;


    public function conditionalSheets(): array
    {
        return [
            'PLO' => new sheet(),
            'PSWDO' => new sheet(),
        ];
    }
}