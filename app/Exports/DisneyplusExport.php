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

    function wareki($year) {

        $eras = [
            ['year' => 2018, 'name' => '令和'],
            ['year' => 1988, 'name' => '平成'],
            ['year' => 1925, 'name' => '昭和'],
            ['year' => 1911, 'name' => '大正'],
            ['year' => 1867, 'name' => '明治']
        ];
    
        foreach($eras as $era) {
    
            $base_year = $era['year'];
            $era_name = $era['name'];
    
            if($year > $base_year) {
    
                $era_year = $year - $base_year;
    
                if($era_year === 1) {
    
                    return $era_name .'元年';
    
                }
    
                return $era_name . $era_year .'年';
    
            }
    
        }
    
        return null;
    
    }
}
