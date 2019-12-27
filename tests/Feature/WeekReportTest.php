<?php

namespace Reportable\Tests\Feature;

use Carbon\Carbon;
use Reportable\Tests\Models\User;
use Reportable\Tests\TestCase;

class WeekReportTest extends TestCase
{
    public function testThisWeekReport()
    {
        $this->assertCount(12, User::thisWeekReport()->get());
        $this->assertCount(3, User::thisWeekReport()->where('status', '=', 'inactive')->get());
    }

    public function testLastWeekReport()
    {
        $this->assertCount(3, User::lastWeekReport()->get());
    }
}
