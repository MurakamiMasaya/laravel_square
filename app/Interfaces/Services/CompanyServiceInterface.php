<?php

namespace App\Interfaces\Services;

interface CompanyServiceInterface{
    
    public function getCompany($company);
    public function getTopThree();
    public function getTwelveEach();
    public function getSearchTenEach($target);
    public function getSearchAll($target);

    public function getReviews($company);
}