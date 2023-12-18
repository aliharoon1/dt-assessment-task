<?php

namespace DTApi\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Notification extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'notifications';
}
