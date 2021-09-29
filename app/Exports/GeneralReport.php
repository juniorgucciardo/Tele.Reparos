<?php

namespace App\Exports;

use App\Models\service_order;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\FromCollection;

class GeneralReport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */


    public function view(): View
    {
        $arr = User::with('service_order.service', 'service_order.type')->get();

        return view('reports.generalReport',[
            'users' => $arr
        ]);
    }
}
