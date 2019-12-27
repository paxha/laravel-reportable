<?php

namespace Reportable\Tests\Feature;

use Carbon\Carbon;
use Reportable\Tests\Models\User;
use Reportable\Tests\TestCase;

class DayReportTest extends TestCase
{
    public function testDailyReport()
    {
        $this->assertCount(9, User::dailyReport()->get());
        $this->assertCount(3, User::dailyReport()->where('status', '=', 'inactive')->get());
        $this->assertCount(3, User::dailyReport(Carbon::yesterday())->get());
        $this->assertCount(3, User::dailyReport(Carbon::now()->subWeek())->get());
        $this->assertCount(3, User::dailyReport(Carbon::now()->subMonth())->get());
        $this->assertCount(3, User::dailyReport(Carbon::now()->subYear())->get());
    }

    public function testTodayReport()
    {
        $this->assertCount(9, User::todayReport()->get());
        $this->assertCount(3, User::todayReport()->where('status', '=', 'inactive')->get());
    }

    public function testYesterdayReport()
    {
        $this->assertCount(3, User::yesterdayReport()->get());
    }
}