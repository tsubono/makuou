<?php
/**
 * Created by PhpStorm.
 * User: arabbit
 * Date: 2018/07/26
 * Time: 23:17
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class Receipt extends  Facade
{
    protected static function getFacadeAccessor() {
        return 'printReceipt';
    }
}