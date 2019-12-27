<?php

namespace Reportable\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Reportable\Traits\Reportable;

class User extends Model
{
    use Reportable;
}
