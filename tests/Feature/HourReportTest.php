<?php

namespace Reportable\Tests\Feature;

use Carbon\Carbon;
use Reportable\Tests\Models\User;
use Reportable\Tests\TestCase;

class HourReportTest extends TestCase
{
    public function testHourlyReport(){
        $this->assertCount(6, User::hourlyReport()->get());
        $this->assertCount(3, User::hourlyReport()->where('status', '=', 'inactive')->get());
        $this->assertCount(9, User::hourlyReport(Carbon::now()->subHour()->subMinute())->get());
        $this->assertCount(6, User::hourlyReport(null, Carbon::now())->get());
        $this->assertCount(6, User::hourlyReport(null, null, Carbon::today())->get());
        $this->assertCount(9, User::hourlyReport(Carbon::now()->subHour()->subMinute(), null, Carbon::today())->get());
        $this->assertCount(9, User::hourlyReport(Carbon::now()->subHour()->subMinute(), Carbon::now(), Carbon::today())->get());
    }
}