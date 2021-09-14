<?php

namespace MobileLogin\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $mobile
 * @property string $code
 * @property Carbon $expire_at
 */
class SmsCode extends Model
{
    use HasFactory;
    protected $fillable=["mobile",'code',"expire_at"];
}
