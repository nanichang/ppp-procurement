<?php
namespace App\Repositories\Countries;

use App\Country;

class EloquentCountriesRepository implements CountriesContract
{
    // public function create($requestData)
    // {
    //    return Equipments::create($requestData);
    // }
    
    // public function find($id)
    // {
    //    return Equipments::find($id);
    // }
    
    
    public function listAllCountries()
    {
        return Country::all()->pluck('name', 'id');
    }


    public function allCountries(){
        return Country::all();
    }
    
    
    // public function destroy($id)
    // {
    //     $client = Equipments::findorFail($id);
    //     return $client->delete();
    // }
    
    // public function update($id, $requestData)
    // {
    //    return Equipments::find($id)->update($requestData);
    // }
    
}