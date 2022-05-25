<?php

namespace App\Imports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportExpense implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Expense([         
            'user_id' => 1,
            'date' => $row['date'],
            'merchant'=> $row['merchant'],
            'total'=> $row['total'],                
            'status'=> 'New',
            'comment'=> $row['comment'],
            'receipt'=> $row['receipt'],
        ]);
    }
}
