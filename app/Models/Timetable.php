<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Timetable extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pharmacy_id',
        'start_time',
        'end_time',
        'date'
    ]; 

    protected $hidden = ['created_at', 'updated_at'];


    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }

    public function getDateDayAttribute($value)
    {
             return $this->date . " - " . Carbon::parse($this->date)->format('l');
        
    }



}
