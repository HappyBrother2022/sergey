<?php

namespace App\Http\Controllers\Api;

use App\Filters\HistoricDataFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\HistoricDataUpdateRequest;
use App\Http\Requests\StoreRequest;
use App\Models\HistoricData;
use Illuminate\Http\Request;

class ForexDataController extends Controller
{
    public function index(Request $request, HistoricDataFilter $filter)
    {
        return HistoricDataController::index($request, $filter, "Forex");
    }

    public function store(StoreRequest $request)
    {
        $url = HistoricData::getForexUrl($request->currency);
        return HistoricDataController::store($url, $request->currency, "Forex");
    }

    public function show($id)
    {
        return HistoricDataController::show($id, "Forex");
    }

    public function update(HistoricDataUpdateRequest $request, $id)
    {
        return HistoricDataController::update($request, $id, "Forex");
    }
}
