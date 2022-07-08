<?php

namespace App\Exports;

use App\Models\Disneyplus;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DisneyplusExport implements FromView
{

    protected $proj_id;

    public function __construct($proj_id)
    {
       $this->proj_id = $proj_id;
    }

    public function view(): View
    {
        return view('excel.export_excel', [
            'disneyplus' => Disneyplus::where('id', $this->proj_id)->get()
        ]);
    }
}
