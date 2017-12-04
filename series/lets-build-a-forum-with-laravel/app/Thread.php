<?php

namespace App;

use App\Acme\Thread\ThreadPath as HasPath;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasPath;
}
