<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class TestModel extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'test';
}
