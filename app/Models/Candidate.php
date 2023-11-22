<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $guarded = ['candidate_id'];
    protected $table = 't_candidate';
    protected $primaryKey = 'candidate_id';
}
