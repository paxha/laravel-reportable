# Laravel Report Generator

## Introduction

This Laravel Eloquent extension provides record according to dates using models.

<p align="center">
<a href="https://travis-ci.org/paxha/laravel-reportable"><img src="https://img.shields.io/travis/paxha/laravel-reportable/master.svg?style=flat-square" alt="Build Status"></a>
<a href="https://github.styleci.io/repos/230404008"><img src="https://github.styleci.io/repos/230404008/shield?branch=master" alt="StyleCI"></a>
<a href="https://packagist.org/packages/paxha/laravel-reportable"><img src="https://poser.pugx.org/paxha/laravel-reportable/d/total.svg?format=flat-square" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/paxha/laravel-reportable"><img src="https://poser.pugx.org/paxha/laravel-reportable/v/stable.svg?format=flat-square" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/paxha/laravel-reportable"><img src="https://poser.pugx.org/paxha/laravel-reportable/license.svg?format=flat-square" alt="License"></a>
</p>


This package provides an event that will generate a unique slug when saving or creating any Eloquent model.

## Installation

    composer require paxha/laravel-reportable

## Usage

-   [Getting Started](#getting-started)
-   [Scopes](#scopes)
    -   [Yearly Report](#yearly-report)
    -   [ThisYear Report](#this-year-report)
    -   [LastYear Report](#last-year-report)
    -   [Monthly Report](#monthly-report)
    -   [ThisMonth Report](#this-month-report)
    -   [LastMonth Report](#last-month-report)
    -   [This Week Report](#this-week-report)
    -   [Last Week Report](#last-week-report)
    -   [Daily Report](#daily-report)
    -   [Today Report](#today-report)
    -   [Yesterday Report](#yesterday-report)
    -   [Hourly Report](#hourly-report)
-   [Custom Query](#custom-query)
-   [Advanced Usage](#advanced-usage)

### Getting Started

Consider the following table schema for hierarchical data:

```php
Schema::create('users', function (Blueprint $table) {
    $table->increments('id');
    $table->timestamps();
});
```

Use the `Reportable` trait in your model to work with reports:

```php
class User extends Model
{
    use \Reportable\Traits\Reportable;
}
```

### Scopes

The trait provides query scopes to filter data by datetime:

-   [`yearlyReport($year = null)`](#yearly-report): provide year-wise record. By default it will provide current year record.
-   [`thisYearReport()`](#this-year-report): provide current year record.
-   [`lastYearReport()`](#last-year-report): provide previous year record.
-   [`monthlyReport($month = null, $year = null)`](#monthly-report): provide month-wise record. By default it will provide current month.
-   [`thisMonthReport()`](#this-month-report): provide current month record.
-   [`lastMonthReport()`](#last-month-report): provide last month record.
-   [`thisWeekReport()`](#this-week-report): provide this week record. (mon - sun)
-   [`lastWeekReport()`](#last-week-report): provide last week record. (mon - sun)
-   [`dailyReport($date = null)`](#daily-report): provide date-wise record. By default it will provide today's record.
-   [`todayReport()`](#today-report): provide today record.
-   [`yesterdayReport()`](#yesterday-report): provide yesterday record.
-   [`hourlyReport($from = null, $to = null, $date = null)`](#hourly-report): provide hour-wise record. By default it will provide records between last hour to current hour.

#### Yearly Report

```php
/*Only Current Year Users*/
$users = User::yearlyReport()->get();

// or

/*2018 Users*/
$year = 2018; // or Carbon date
$users = User::yearlyReport($year)->get();
```

#### This Year Report

```php
/*Only Current Year Users*/
$users = User::thisYearReport()->get();
```

#### Last Year Report

```php
/*Only Last Year Users*/
$users = User::lastYearReport()->get();
```

#### Monthly Report

```php
/*Only Current Month Users*/
$users = User::monthlyReport()->get();

// or

/*November Current Year Users*/
$month = 11; // or Carbon date
$users = User::monthlyReport($month)->get();

// or

/*November 2018 Year Users*/
$month = 11; // or Carbon date
$year = 2018; // or Carbon date
$users = User::monthlyReport($month, $year)->get();
```

#### This Month Report

```php
/*Only Current Month Users*/
$users = User::thisMonthReport()->get();
```

#### Last Month Report

```php
/*Only Last Month Users*/
$users = User::thisMonthReport()->get();
```

#### This Week Report

```php
/*Only Current Week Users (Mon - Sun)*/
$users = User::thisWeekReport()->get();
```

#### Last Week Report

```php
/*Only Last Week Users (Mon - Sun)*/
$users = User::lastWeekReport()->get();
```

#### Daily Report

```php
/*Only Today's Users*/
$users = User::dailyReport()->get();

// or

/*December 27, 2019 Users*/
$date = '2019-12-27'; // or Carbon date
$users = User::dailyReport($date)->get();
```

#### Today Report

```php
/*Only Today's Users*/
$users = User::todayReport()->get();
```

#### Yesterday Report

```php
/*Only Yesterday's Users*/
$users = User::yesterdayReport()->get();
```

#### Hourly Report

```php
/*Only Last hour to current hour's Users*/
$users = User::hourlyReport()->get();

// or

/*Only 7 am to 2pm Users*/

$from = '07:00'; // or Carbon time
$to = '14:00'; // or Carbon time
$users = User::hourlyReport($from, $to)->get();

// or

/*Only 7 am to 2pm at December 27, 2019 Users*/

$from = '07:00'; // or Carbon time
$to = '14:00'; // or Carbon time
$date = '2019-12-27'; // or Carbon date
$users = User::hourlyReport($from, $to, $date)->get();
```

### Custom Query

You can implement your own conditions or do whatever you want with query.

```php
$users = User::dailyReport()->where('status', '=', 'inactive')->get();
```

### Advanced Usage

```php
$data = [];

$date = Carbon::now()->firstOfMonth();
while ($date <= Carbon::now()->endOfMonth()) {
    $users = User::dailyReport($date)
        ->when('condition', function ($query) {
            $query->where('column', 'value');
        })
        ->whereNotIn('column', ['value1', 'value2'])
        ->where('column', 'operator', 'value')
        ->get();

    $data[] = $users;
    $date = $date->copy()->addDay();
}
```

## License

This is open-sourced laravel library licensed under the [MIT license](https://opensource.org/licenses/MIT).
