<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;

class UsersExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    public function _contruct(array $data)
    {
        $this->data =$data;
    }

    public function array(): array{

        return $this->data;
    }
}
