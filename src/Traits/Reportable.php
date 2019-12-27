<?php

namespace Reportable\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait Reportable
 * @package Reportable\Traits
 */
trait Reportable
{
    public function scopeYearlyReport(Builder $query, $year = null)
    {
        return $query->whereYear('created_at', $year ?? Carbon::now()->year);
    }

    public function scopeThisYearReport(Builder $query)
    {
        return $query->whereYear('created_at', Carbon::now()->year);
    }

    public function scopeLastYearReport(Builder $query)
    {
        return $query->whereYear('created_at', Carbon::now()->subYear()->year);
    }

    public function scopeMonthlyReport(Builder $query, $month = null, $year = null)
    {
        return $query->whereYear('created_at', $year ?? Carbon::now()->year)->whereMonth('created_at', $month ?? Carbon::now()->month);
    }

    public function scopeThisMonthReport(Builder $query)
    {
        return $query->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month);
    }

    public function scopeLastMonthReport(Builder $query)
    {
        return $query->whereYear('created_at', Carbon::now()->subMonth()->year)->whereMonth('created_at', Carbon::now()->subMonth()->month);
    }

    public function scopeThisWeekReport(Builder $query)
    {
        return $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
    }

    public function scopeLastWeekReport(Builder $query)
    {
        return $query->whereBetween('created_at', [Carbon::now()->startOfWeek()->subWeek()->format('Y-m-d'), Carbon::now()->endOfWeek()->subWeek()->format('Y-m-d')]);
    }

    public function scopeDailyReport(Builder $query, $date = null)
    {
        return $query->whereDate('created_at', $date ?? Carbon::today());
    }

    public function scopeTodayReport(Builder $query)
    {
        return $query->whereDate('created_at', Carbon::today());
    }

    public function scopeYesterdayReport(Builder $query)
    {
        return $query->whereDate('created_at', Carbon::yesterday());
    }

    public function scopeHourlyReport(Builder $query, $from = null, $to = null, $date = null)
    {
        return $query->whereDate('created_at', $date ?? Carbon::today())->whereTime('created_at', '>', $from ?? Carbon::now()->subHour())->whereTime('created_at', '<=', $to ?? Carbon::now());
    }
}
