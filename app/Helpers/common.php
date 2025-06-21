<?php

use App\Models\AppData;

function getdata(){
    return AppData::get();
}