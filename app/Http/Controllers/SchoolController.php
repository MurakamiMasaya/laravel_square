<?php

namespace App\Http\Controllers;

use App\Interfaces\SearchRepositoryInterface;
use App\Interfaces\DisplayRepositoryInterface;
use App\Models\ReviewSchool;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    private $searchRepository;
    private $displayRepository;

    public function __construct(
        SearchRepositoryInterface $searchRepository,
        DisplayRepositoryInterface $displayRepository
        ) {
        $this->searchRepository = $searchRepository;
        $this->displayRepository = $displayRepository;
    }

    public function index(){

        $user = $this->displayRepository->getAuthenticatedUser();
        // #TODO: クエリビルダで取得したデータに順位をつけたい。
        $schools = $this->displayRepository->getTargetsTwelveEach('School');
        
        $companies = $this->displayRepository->getTargetsThreeEach('Company');
        $articles = $this->displayRepository->getArticlesEightEach();

        return view('school.index', compact('user', 'schools', 'companies', 'articles'));
    }

    public function search(Request $request){

        $user = $this->displayRepository->getAuthenticatedUser();
        $target = $request->input('target');

        // ＃TODO: 大文字小文字全角半角を区別しないように修正
        $schoolsSearch = $this->searchRepository->getSearchTargetsTenEach('School', 'name', $target);
        $schoolsAll = $this->searchRepository->getSearchTargetsAll('School', 'name', $target);

        $companies = $this->displayRepository->getTargetsThreeEach('Company');
        $articles = $this->displayRepository->getArticlesEightEach();

        return view('school.candidates', compact('user', 'target', 'schoolsSearch', 'schoolsAll', 'companies', 'articles'));
    }

    public function detail(Request $request, $school){

        $user = $this->displayRepository->getAuthenticatedUser();

        $schoolData = School::where('id', $school)->first();
        $reviewSchools = ReviewSchool::where('school_id', $school)->orderBy('gr', 'desc')->paginate(10); 

        $companies = $this->displayRepository->getTargetsThreeEach('Company');
        $articles = $this->displayRepository->getArticlesEightEach();

        // dd($reviewCompanies);
        return view('school.detail', compact('user', 'schoolData', 'reviewSchools', 'companies', 'articles'));
    }
}
