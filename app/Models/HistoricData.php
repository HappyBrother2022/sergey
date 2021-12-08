<?php

namespace App\Models;

use App\Filters\HistoricDataFilter;
use Illuminate\Database\Eloquent\Model;

class HistoricData extends Model
{
    protected $fillable = ['open', 'close', 'high', 'low', 'adjusted_close', 'volume', 'date', 'type'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public static function getStockUrl($company = "AAPL")
    {
        return "https://eodhistoricaldata.com/api/eod/".$company.".US?api_token=617e414f2d6394.98204481&fmt=json";
    }

    public static function getForexUrl($currency = "EUR")
    {
        return "https://eodhistoricaldata.com/api/eod/".$currency.".FOREX?api_token=617e414f2d6394.98204481&fmt=json";
    }

    public static function getCryptoUrl($currency = "BTC")
    {
        return "https://eodhistoricaldata.com/api/eod/".$currency."-USD.CC?api_token=617e414f2d6394.98204481&fmt=json";
    }
    
    public function scopeFilter($query, HistoricDataFilter $filters)
    {
        return $filters->apply($query);
    }
}
