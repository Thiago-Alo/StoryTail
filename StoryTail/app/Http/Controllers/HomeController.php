<?php

namespace App\Http\Controllers;

use App\AgeGroup;
use App\Book;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use phpDocumentor\Reflection\Types\ClassString;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
       /* $this->middleware(['auth', 'verified','can:manage-tasks'], ['except' => [
            'index',
        ]]);*/
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user, Request $request)
    {
        $ageGroups = AgeGroup::all()->sortBy('age_group',SORT_NUMERIC);

        if ($request->has('search') && $request->get('search') != null) {
            $search = $request->search;
            $books = Book::where('title', 'ilike', '%' . $search . '%')
                ->orWhereHas('authors', function ($q) use ($search) {
                    $q->where('name', 'ilike', '%' . $search . '%');
                })->paginate(10)->appends('search', $search);


        } elseif (!empty($request['age-range'])){


            $ageGroupRequest=AgeGroup::where('age_group',$request['age-range'])->first();

            $books= $ageGroupRequest->books()->orderBy('averageRating','Desc')->paginate(10)->appends('age-range',$request['age-range']);


        } else{

            $books = Book::orderBy('averageRating','Desc')->paginate(10);

        }



        return view('pages.home', ['books' => $books,'ageGroups'=>$ageGroups]);


    }

    public function wordleView()
    {
        return view('pages.wordle');
    }


}
