<?php
namespace App\Repositories\States;

use App\State;

class EloquentStateRepository implements StateContract
{
   
    public function listAllStates()
    {
        return State::all()->pluck('name', 'id');
    }
    
}