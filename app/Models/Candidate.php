<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $keyType = 'string';
    protected $autoIncrement = false;

    protected $fillable = ['name', 'education', 'birthday', 'experience', 'last_position', 'applied_position', 'top_skills', 'email', 'phone', 'resume_url'];
}
