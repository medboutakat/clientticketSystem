<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    protected $fillable = ['name','prefixe','suffixe','value','length'];
}
