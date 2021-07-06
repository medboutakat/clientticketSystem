<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperationStatus extends BaseModel
{   
    protected $fillable = ['name','remark','deleted' ];
} 