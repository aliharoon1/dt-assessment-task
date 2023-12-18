<?php

namespace DTApi\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Job extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'jobs';
}
