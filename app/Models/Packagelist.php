<?php

namespace App\Models;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packagelist extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = ['start_date' => 'datetime'];

    //One To Many With User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //One To Many With Package
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
