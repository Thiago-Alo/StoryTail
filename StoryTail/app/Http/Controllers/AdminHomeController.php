<?php

namespace App\Http\Controllers;

use App\ActivityType;
use App\AgeGroup;
use App\Author;
use App\Book;
use App\Theme;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $ageGroups = AgeGroup::all()->sortBy('age_group', SORT_NUMERIC);
        $authors = Author::orderBy('name')->paginate(8, ['*'], 'authors');



        $books = Book::orderBy('averageRating', 'Desc')->get();


        $themes = Theme::orderBy('name')->paginate(8, ['*'], 'themes');;
        $activityTypes = ActivityType::orderBy('type')->paginate(8, ['*'], 'activityTypes');

        return view('pages.admin.admin-home', ['authors' => $authors, 'books' => $books, 'ageGroups' => $ageGroups, 'themes' => $themes, 'activityTypes' => $activityTypes]);


    }


}
