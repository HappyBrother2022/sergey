<?php

namespace App\Http\Controllers\Api;

use App\Filters\HistoricDataFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\HistoricDataUpdateRequest;
use App\Models\HistoricData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoricDataController extends Controller
{
    public static function index(Request $request, HistoricDataFilter $filter, $type)
    {
        $stockDatas = HistoricData::filter($filter)
        ->where(["type" => $type, "user_id" => Auth::id()])
        ->latest('date')
        ->paginate($request->per_page);
        return response()->json([
            'data' => $stockDatas
        ], 200);
    }

    public static function store($url, $currency, $type)
    {
        try {
            $lastData = HistoricData::where(["type" => $type, "user_id" => Auth::id()])
            ->latest('date')
            ->first();
            $date = date("Y-m-d", strtotime("-2 year", time()));
            if ($lastData == null) {
                $url = $url . "&from=" . $date;
            }
            else {
                $url = $url . "&from=" . date('Y-m-d', strtotime($lastData->date. ' + 1 days'));
            }
            $dataset = getCurlData($url);
            $stockDatas = json_decode($dataset);
            $userData = ["user_id" => Auth::id(), "type" => $type, "currency" => $currency, "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")];
            foreach ($stockDatas as $key => $stockData) {
                $stockDatas[$key] = array_merge((array)$stockData, $userData);
            }
            HistoricData::insert($stockDatas);
            return response()->json([
                "message" => "Data stored"
            ]);
        } catch (Exception $ex) {
            return response()->json([
                "message" => "Server error"
            ], 500);
        }
    }

    public static function show($id, $type)
    {
        try {
            $data = HistoricData::where(["type" => $type, "user_id" => Auth::id()])
            ->find($id);
            if ($data == null) {
                return response()->json([
                    "message" => "Data not found"
                ], 404);
            }
            return response()->json([
                "data" => $data
            ], 201);
        } catch (Exception $ex) {
            return response()->json([
                "message" => "Server error"
            ], 500);
        }
        
    }

    public static function update(HistoricDataUpdateRequest $request, $id, $type)
    {
        try {
            unset($request["date"], $request["type"], $request["currency"], $request["user_id"], $request["created_at"], $request["updated_at"]);
            $data = HistoricData::where(["type" => $type, "user_id" => Auth::id()])
            ->find($id);
            if ($data == null) {
                return response()->json([
                    "message" => "Data not found"
                ], 404);
            }
            $data->update($request->all());
            return response()->json([
                "message" => "Data updated"
            ], 201);
        } catch (Exception $ex) {
            return response()->json([
                "message" => "Server error"
            ], 500);
        }
        
    }
}
