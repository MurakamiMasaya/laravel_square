<?php

namespace App\Services;

use App\Interfaces\Services\SchoolServiceInterface;
use App\Interfaces\Repositories\SchoolRepositoryInterface;

class SchoolService implements SchoolServiceInterface {

    private $schoolRepository;

    public function __construct(
        SchoolRepositoryInterface $schoolRepository
        ) {
        $this->schoolRepository = $schoolRepository;
    }

    public function getSchool($target, $order = null, $paginate = null, $limit = null){
        return $this->schoolRepository->getSchool($target, $order, $paginate, $limit);
    }

    public function searchSchool($target, $column, $order, $paginate = null, $limit = null){
        return $this->schoolRepository->searchSchool($target, $column, $order, $paginate, $limit);
    }

    public function getReview($target, $column, $order = null, $paginate = null, $limit = null){
        return $this->schoolRepository->getReview($target, $column, $order, $paginate, $limit);
    }

    public function createReview($request){
        return $this->schoolRepository->createReview($request);
    }

    public function deleteReview($id){
        return $this->schoolRepository->deleteReview($id);
    }

    public function createSchool($request){
        return $this->schoolRepository->createSchool($request);
    }

    public function deleteSchool($id){
        return $this->schoolRepository->deleteSchool($id);
    }
}