<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DisneyplusExport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ExcelController extends Controller
{
    public function index() {
        $type = 'xlsx';

        $create_excel = array(
            "test" => "0001"
        );

        $now = \DateTime::createFromFormat('U.u', microtime(true));
        $timestamp = $now->format("YmdHisu");

        //$excel = Excel::download(new DisneyplusExport(1), 'disney.xlsx');
        $fileName = $timestamp."_"."disney.xlsx";
        log::debug($fileName);
        Excel::store(new DisneyplusExport(1), $fileName);
        $path = Storage::disk('local')->path($fileName);
        log::debug($path);

        // $excelFile = \Excel::download(function($excel) use ($create_excel) {
        //     $excel->sheet('mySheet', function($sheet) use ($create_excel)
        //     {
        //         $sheet->fromArray($create_excel);
        //     });
        // }, "test.xlsx");

        Mail::send(['html'=>'email.email_body'], [], function($message) use ($path){

            $message->to('aung@floboard.co.jp')->subject('Email Subject Line');
            $message->from('johnsnow.49920@gmail.com');
            $message->attachData(file_get_contents($path), "disney456.xlsx");
       
        });

        \File::delete($path);
    }
}
