<?php
namespace App\Repositories\CompletedRegistration;

interface CompletedRegistrationContract       
{
    
    public function listAllRegistrations();
    
    public function create($request);

    public function getRegistrationsByUserId();

    public function getRegistrationsById($id);
}

