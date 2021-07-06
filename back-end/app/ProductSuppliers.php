<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSuppliers extends BaseModel
{
    protected $fillable = ['name','city_code','adress','latutude','langitude','remark'];
     
}
