<?php

namespace App\Http\Controllers\Api;

use App\Filters\HistoricDataFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\HistoricDataUpdateRequest;
use App\Http\Requests\StoreRequest;
use App\Models\HistoricData;
use Illuminate\Http\Request;

class StockDataController extends Controller
{
    public function index(Request $request, HistoricDataFilter $filter)
    {
        return HistoricDataController::index($request, $filter, "Stock");
    }

    public function store(Request $request)
    {
        $url = HistoricData::getStockUrl($request->company);
        return HistoricDataController::store($url, $request->company, "Stock");
    }

    public function show($id)
    {
        return HistoricDataController::show($id, "Stock");
    }

    public function update(HistoricDataUpdateRequest $request, $id)
    {
        return HistoricDataController::update($request, $id, "Stock");
    }
}
