<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Report;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;

class ReportController extends BaseController
{
    public function index()
    {
        //
    }


    public function store(StoreReportRequest $request)
    {
        $input = $request->all();
        $report = Report::create($input);

        if ($report) {
            return $this->sendResponse($report, 'نجحت عملية الابلاغ');
        } else {
            return $this->sendErrors('فشل في عملية الابلاغ', ['error' => 'not report on store']);
        }
    }


    public function show(Report $report)
    {
        //
    }
}
