<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class EmployerImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        $company = Company::updateOrCreate([
            'name' => $row['bedrijf'],
            'city' => $row['stad'],
            'image' => '/images/logo.png'
        ]);


        return $company->users()->updateOrCreate([
            'email'     => $row['email'],
        ],
        [
            'password' => Hash::make($row['password']),
            'role_id'      => 2
        ]);
    }

    public function uniqueBy()
    {
        return 'email';
    }
}
