<?php

namespace App\Excel;

use App\charter;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class sheet implements ToCollection
{
     /**
     * @param array $row
     *
     * @return charter|null
     */
    public function collection(Collection $row)
    {
        foreach ($row as $key => $value) {
            if ($key != 0 && $value[6] != null){

                charter::create([
                    'service_name' => $value[0],
                    'steps' => $value[1],
                    'requirements' => $value[2],
                    'forms_used' => $value[3],
                    'processing_time' => $value[4],
                    'service_provider' => $value[5],
                    'dept' => $value[6],
                    'service_code' => $value[7]
                    ]);
            }

        }
    }
}