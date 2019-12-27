<?php

namespace Reportable\Tests\Feature;

use Carbon\Carbon;
use Reportable\Tests\Models\User;
use Reportable\Tests\TestCase;

class MonthReportTest extends TestCase
{
    public function testMonthlyReport()
    {
        $this->assertCount(15, User::monthlyReport()->get());
        $this->assertCount(3, User::monthlyReport()->where('status', '=', 'inactive')->get());
        $this->assertCount(3, User::monthlyReport(Carbon::now()->subMonth())->get());
        $this->assertCount(15, User::monthlyReport(null, Carbon::now())->get());
        $this->assertCount(3, User::monthlyReport(Carbon::now()->subMonth(), Carbon::now())->get());
    }

    public function testThisMonthReport()
    {
        $this->assertCount(15, User::thisMonthReport()->get());
        $this->assertCount(3, User::thisMonthReport()->where('status', '=', 'inactive')->get());
    }

    public function testLastMonthReport()
    {
        $this->assertCount(3, User::lastMonthReport()->get());
    }
}
