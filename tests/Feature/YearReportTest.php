<?php

namespace Reportable\Tests\Feature;

use Carbon\Carbon;
use Reportable\Tests\Models\User;
use Reportable\Tests\TestCase;

class YearReportTest extends TestCase
{
    public function testYearlyReport()
    {
        $this->assertCount(18, User::yearlyReport()->get());
        $this->assertCount(3, User::yearlyReport()->where('status', 'inactive')->get());
        $this->assertCount(3, User::yearlyReport(Carbon::now()->subYear())->get());
    }

    public function testThisYearReport()
    {
        $this->assertCount(18, User::thisYearReport()->get());
        $this->assertCount(3, User::thisYearReport()->where('status', 'inactive')->get());
    }

    public function testLastYearReport()
    {
        $this->assertCount(3, User::lastYearReport(Carbon::now()->subYear())->get());
    }
}
