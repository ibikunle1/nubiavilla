<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'date',
        'merchant',
        'total',                
        'status',
        'comment',
        'receipt',               
    ];
        protected $dates = ['date', 'another_date_field'];

    public function user(){
        return $this->belongsTo('App\User');
    } 


}
