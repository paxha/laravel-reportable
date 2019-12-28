<?php

namespace Reportable\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait Reportable.
 */
trait Reportable
{
    /**
     * @param Builder $query
     * @param null    $year
     *
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeYearlyReport(Builder $query, $year = null)
    {
        return $query->whereYear('created_at', $year ?? Carbon::now()->year);
    }

    /**
     * @param Builder $query
     *
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeThisYearReport(Builder $query)
    {
        return $query->whereYear('created_at', Carbon::now()->year);
    }

    /**
     * @param Builder $query
     *
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeLastYearReport(Builder $query)
    {
        return $query->whereYear('created_at', Carbon::now()->subYear()->year);
    }

    /**
     * @param Builder $query
     * @param null    $month
     * @param null    $year
     *
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeMonthlyReport(Builder $query, $month = null, $year = null)
    {
        return $query->whereYear('created_at', $year ?? Carbon::now()->year)->whereMonth('created_at', $month ?? Carbon::now()->month);
    }

    /**
     * @param Builder $query
     *
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeThisMonthReport(Builder $query)
    {
        return $query->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month);
    }

    /**
     * @param Builder $query
     *
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeLastMonthReport(Builder $query)
    {
        return $query->whereYear('created_at', Carbon::now()->subMonth()->year)->whereMonth('created_at', Carbon::now()->subMonth()->month);
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeThisWeekReport(Builder $query)
    {
        return $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeLastWeekReport(Builder $query)
    {
        return $query->whereBetween('created_at', [Carbon::now()->startOfWeek()->subWeek()->format('Y-m-d'), Carbon::now()->endOfWeek()->subWeek()->format('Y-m-d')]);
    }

    /**
     * @param Builder $query
     * @param null    $date
     *
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeDailyReport(Builder $query, $date = null)
    {
        return $query->whereDate('created_at', $date ?? Carbon::today());
    }

    /**
     * @param Builder $query
     *
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeTodayReport(Builder $query)
    {
        return $query->whereDate('created_at', Carbon::today());
    }

    /**
     * @param Builder $query
     *
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeYesterdayReport(Builder $query)
    {
        return $query->whereDate('created_at', Carbon::yesterday());
    }

    /**
     * @param Builder $query
     * @param null    $from
     * @param null    $to
     * @param null    $date
     *
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeHourlyReport(Builder $query, $from = null, $to = null, $date = null)
    {
        return $query->whereDate('created_at', $date ?? Carbon::today())->whereTime('created_at', '>', $from ?? Carbon::now()->subHour())->whereTime('created_at', '<=', $to ?? Carbon::now());
    }
}
