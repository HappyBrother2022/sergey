<?php

namespace App\Http\Controllers\Api;

use App\Filters\HistoricDataFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\HistoricDataUpdateRequest;
use App\Http\Requests\StoreRequest;
use App\Models\HistoricData;
use Illuminate\Http\Request;

class CryptoDataController extends Controller
{
    public function index(Request $request, HistoricDataFilter $filter)
    {
        return HistoricDataController::index($request, $filter, "Crypto");
    }

    public function store(StoreRequest $request)
    {
        $url = HistoricData::getCryptoUrl($request->currency);
        return HistoricDataController::store($url, $request->currency, "Crypto");
    }

    public function show($id)
    {
        return HistoricDataController::show($id, "Crypto");
    }

    public function update(HistoricDataUpdateRequest $request, $id)
    {
        return HistoricDataController::update($request, $id, "Crypto");
    }
}
