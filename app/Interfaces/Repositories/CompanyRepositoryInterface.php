<?php

namespace App\Interfaces\Repositories;

interface CompanyRepositoryInterface{
    
    public function getCompany($target, $order, $paginate, $limit);
    public function searchCompany($target, $column, $order, $paginate, $limit);

    public function getReviews($target, $column, $order, $paginate, $limit);

    public function createReview($request);
    public function deleteReview($id);
}