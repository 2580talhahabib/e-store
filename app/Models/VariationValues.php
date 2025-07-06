<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationValues extends Model
{
    use HasFactory;
     protected $guarded=[];
 public function variation(){
    $this->belongsTo(Variation::class);
 }
}