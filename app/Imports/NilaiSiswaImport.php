<?php

namespace App\Imports;

use App\Models\DetailNilai;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class NilaiSiswaImport implements ToModel, WithStartRow, WithUpserts
{
    protected $nilai_id = null;

    public function __construct($nilai_id)
    {
        $this->nilai_id = $nilai_id;
    }

    public function startRow(): int
    {
        return 9;
    }


    public function uniqueBy()
    {
        return ['nilai_id','siswa_id'];
    }

    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        // $row = $row->toArray();
        // foreach ($rows as $row) {
        // dd($row);
        if (!isset($row['1'])) {
            return null;
        }

        DetailNilai::updateOrCreate([
            'nilai_id' => $this->nilai_id,
            'siswa_id' => $row['1'],
        ],['nilai_angka' => $row['4']]);

        // DetailNilai::create([
        //     'nilai_id' => $this->nilai_id,
        //     'siswa_id' => $row['1'],
        //     'nilai_angka' => $row['4']
        // ]);

    }
}
