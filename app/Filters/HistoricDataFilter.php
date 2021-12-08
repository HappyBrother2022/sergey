<?php

namespace App\Filters;

class HistoricDataFilter extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['currency', 'from', 'to', 'sort_by', 'search'];

    /**
     * Filter the query by currency.
     *
     * @param  string $currency
     * @return
     */
    protected function currency($currency)
    {
        return $this->builder
            ->where('currency', $currency);
    }

    /**
     * Filter the query by from.
     *
     * @param  string $from
     * @return
     */
    protected function from($from)
    {
        return $this->builder
            ->whereDate('date', '>=', $from);
    }

    /**
     * Filter the query by to.
     *
     * @param  string $to
     * @return
     */
    protected function to($to)
    {
        return $this->builder
            ->whereDate('date', '<=', $to);
    }

    protected function sort_by($sort_by)
    {
        $sort_by = explode('.', $sort_by);
        $sort_by[1] == 1 ? $sort_by[1] = 'asc' : $sort_by[1] = 'desc';
        return $this->builder->orderBy($sort_by[0], $sort_by[1]);
    }

    protected function search($global)
    {
        return $this->builder->where(function ($query) use ($global) {
            $query->orWhere('name', 'ilike', '%' . $global . '%');
        });
    }
}
