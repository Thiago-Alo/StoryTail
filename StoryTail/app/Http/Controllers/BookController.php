<?php

namespace App\Http\Controllers;

use App\Activity;
use App\ActivityType;
use App\AgeGroup;
use App\Author;
use App\Book;
use App\TemporaryFile;
use App\Theme;
use App\User;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mpdf\Mpdf;
use PDF;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search') && $request->get('search') != null) {
            $search= $request->search;
            $books = Book::where('title', 'ilike', '%' . $search . '%')
                ->orWhereHas('authors', function ($q) use ($search){
                    $q->where('name', 'ilike', '%' . $search . '%');
                })->paginate(20)->appends('search', $search);


            return view('pages.admin.books.list', (['books' => $books]));

        }


        if ($request->has('orderby')) {

            try {

                   $column = Str::beforeLast($request->orderby, '_');
                   $order = Str::afterLast($request->orderby, '_');

                   $books = Book::orderBy($column, $order)
                       ->whereNotNull($column)->paginate(20)->appends('orderby', $request->orderby);



                return view('pages.admin.books.list', ['books' => $books]);


            } catch (\Exception $e) {
                $books = Book::orderBy('title')->paginate(20);
                return view('pages.admin.books.list', ['books' => $books]);

            }

        } else {

            $books = Book::orderBy('title')->paginate(20);
            return view('pages.admin.books.list', ['books' => $books]);

        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ageGroups = AgeGroup::all()->sortBy('age_group',SORT_NUMERIC);
        $authors = Author::orderBy('name')->get();
        $themes = Theme::orderBy('name')->get();
        $activityTypes = ActivityType::orderBy('type')->get();


        return view('pages.admin.books.create', ['authors' => $authors,'ageGroups' => $ageGroups, 'themes' => $themes, 'activityTypes' => $activityTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request['title'] = Str::ucfirst($request->title);
        $request['illustrator'] = ucwords($request->illustrator);


        $this->validate($request, [
            'title' => 'required|max:50|unique:books,title',
            'ageGroup' => 'required|array',
            'author' => 'required|array',
            'illustrator' => 'max:40',
            'summary' => 'required|max:200',
            'bookPDF' => 'required|string',
            'bookTheme' => 'required|array'
            /*'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'*/
        ]);

        if (!empty($request->activityType) || !empty($request->activity)) {


            $this->validate($request, [
                'activity' => 'required|max:200',
                'activityType' => 'required|array',

            ]);

        }


        $book = new Book();


        try {


            $temporaryFile = TemporaryFile::where('folder', $request->bookPDF)->first();


            $book->title = $request->title;
            $book->illustrator = $request->illustrator;
            $book->summary = $request->summary;
            $book->numberPages = $temporaryFile->numberPages;
            if (!empty($request->activityType) || !empty($request->activity)) {
                $book->activity = $request->activity;

            }


            $book->save();


            if (!empty($request->activityType) || !empty($request->activity)) {
                foreach ($request->activityType as $activityType) {

                    $book->activityTypes()->attach($activityType);


                }
            }


            foreach ($request->bookTheme as $theme) {

                $book->themes()->attach($theme);


            }

            foreach ($request->ageGroup as $ageGroupBook) {

                $book->ageGroups()->attach($ageGroupBook);


            }

            foreach ($request->author as $bookAuthor) {

                $book->authors()->attach($bookAuthor);


            }


            $filepath = 'public/files/books/' . $book->id . '/' . now()->timestamp . '-' . $temporaryFile->filename;
            $filepathDatabase = 'storage/files/books/' . $book->id . '/' . now()->timestamp . '-' . $temporaryFile->filename;


            if ($temporaryFile) {

                Storage::copy('public/files/books/temp/' . $request->bookPDF
                    . '/' . $temporaryFile->filename, $filepath);

                if (Storage::exists($filepath)) {
                    Storage::deleteDirectory('public/files/books/temp/' . $request->bookPDF);
                    $book->book_url = $filepathDatabase;


                    Storage::disk('public')->makeDirectory('files/books/' . $book->id . '/cover');
                    $coverFilePath = 'storage/files/books/' . $book->id . '/cover/cover' . now()->timestamp . '-' . $temporaryFile->filename;
                    $coverExtract = $this->extractPages($filepathDatabase, [1]);

                    $coverExtract->Output($coverFilePath, 'F');


                    $book->cover = $coverFilePath;

                    $book->save();
                    $temporaryFile->delete();
                    toastr()->success('The book ' . $book->title . ' was successfully created.');
                    return back();
                } else {
                    $book->forceDelete();
                    $book->ageGroups()->detach();
                    $book->themes()->detach();
                    $book->activityTypes()->detach();
                    toastr()->error('An error has occurred during the creation of the book. Please try again later.');
                    return back();

                }


            }

        } catch (\Exception $exception) {
            $book->forceDelete();
            $book->themes()->detach();
            $book->ageGroups()->detach();
            $book->activityTypes()->detach();
            toastr()->error('An error has occurred during creation of the book. Please try again later.');
            return back();
        }

        return back();
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $ageGroups = AgeGroup::all()->sortBy('age_group',SORT_NUMERIC);
        $themes = Theme::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();
        $activityTypes = ActivityType::orderBy('type')->get();
        return view('pages.admin.books.show', ['authors' => $authors,'book' => $book, 'ageGroups' => $ageGroups, 'themes' => $themes, 'activityTypes' => $activityTypes]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $ageGroups = AgeGroup::all()->sortBy('age_group',SORT_NUMERIC);
        $themes = Theme::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();
        $activityTypes = ActivityType::orderBy('type')->get();
        return view('pages.admin.books.edit', ['authors' => $authors,'book' => $book, 'ageGroups' => $ageGroups, 'themes' => $themes, 'activityTypes' => $activityTypes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {

        $request['title'] = Str::ucfirst($request->title);
        $request['illustrator'] = Str::ucfirst($request->illustrator);

        /*Editing book without editing cover or pdf*/

        $this->validate($request, [
            'title' => 'required|max:50',
            'ageGroup' => 'required|array',
            'author' => 'required|array',
            'illustrator' => 'max:40',
            'summary' => 'required|max:200',
            'bookTheme' => 'required|array'

        ]);

        if (!empty($request->activityType) || !empty($request->activity)) {

            $this->validate($request, [
                'activity' => 'required|max:200',
                'activityType' => 'required|array',

            ]);

        }


        $book->title = $request->title;
        $book->illustrator = $request->illustrator;
        $book->summary = $request->summary;
        $book->activity = $request->activity;
        /*$book->numberPages = $temporaryFile->numberPages;*/
        $book->activityTypes()->detach();
        if (!empty($request->activityType) || !empty($request->activity)) {
            $book->activity = $request->activity;

            foreach ($request->activityType as $activityType) {

                $book->activityTypes()->attach($activityType);


            }
        }

        if (empty($request->bookPDF) && empty($request->cover)) {

            try {
                $book->save();

                $book->themes()->detach();
                foreach ($request->bookTheme as $theme) {

                    $book->themes()->attach($theme);

                }

                $book->ageGroups()->detach();
                foreach ($request->ageGroup as $ageGroupBook) {

                    $book->ageGroups()->attach($ageGroupBook);


                }

                $book->authors()->detach();
                foreach ($request->author as $bookAuthor) {

                    $book->authors()->attach($bookAuthor);


                }

                toastr()->success('The book ' . $book->title . ' was successfully edited.');
                return back();


            } catch (\Exception $e) {


                toastr()->error('An error has occurred during the edition of the book. Please try again later.');
                return back();

            }

            /*Editing book with cover or pdf*/
        } else {

            $this->validate($request, [
                'bookPDF' => 'string',
                'cover' => 'string',

            ]);
            /*Editing book + pdf*/
            if (!empty($request->bookPDF) && empty($request->cover)) {
                $temporaryFileBook = TemporaryFile::where('folder', $request->bookPDF)->first();
                $book->numberPages = $temporaryFileBook->numberPages;


                $filepath = 'public/files/books/' . $book->id . '/' . now()->timestamp . '-' . $temporaryFileBook->filename;
                $filepathDatabase = 'storage/files/books/' . $book->id . '/' . now()->timestamp . '-' . $temporaryFileBook->filename;
                try {
                    if ($temporaryFileBook) {

                        Storage::copy('public/files/books/temp/' . $request->bookPDF
                            . '/' . $temporaryFileBook->filename, $filepath);


                        if (Storage::exists($filepath)) {


                            Storage::deleteDirectory('public/files/books/temp/' . $request->bookPDF);
                            Storage::delete(Str::replaceFirst('storage', 'public', $book->book_url));
                            Storage::delete(Str::replaceFirst('storage', 'public', $book->cover));
                            $book->book_url = $filepathDatabase;

                            $coverFilePath = 'storage/files/books/' . $book->id . '/cover/cover' . now()->timestamp . '-' . $temporaryFileBook->filename;
                            $coverExtract = $this->extractPages($filepathDatabase, [1]);

                            $coverExtract->Output($coverFilePath, 'F');

                            $book->cover = $coverFilePath;


                            $book->save();
                            $temporaryFileBook->delete();

                            $book->themes()->detach();
                            foreach ($request->bookTheme as $theme) {

                                $book->themes()->attach($theme);

                            }
                            $book->ageGroups()->detach();
                            foreach ($request->ageGroup as $ageGroupBook) {

                                $book->ageGroups()->attach($ageGroupBook);

                            }

                            $book->authors()->detach();
                            foreach ($request->author as $bookAuthor) {

                                $book->authors()->attach($bookAuthor);


                            }

                            toastr()->success('The book ' . $book->title . ' was successfully edited.');
                            return back();

                        } else {
                            toastr()->error('An error has occurred during the edition of the book. Please try again later.');
                            return back();

                        }


                    }

                } catch (\Exception $e) {


                    toastr()->error('An error has occurred during the edition of the book. Please try again later.');
                    return back();

                }


                /*Editing book + cover*/
            } elseif (empty($request->bookPDF) && !empty($request->cover)) {

                $temporaryFileCover = TemporaryFile::where('folder', $request->cover)->first();


                $filepathCover = 'public/files/books/' . $book->id . '/cover/cover' . now()->timestamp . '-' . $temporaryFileCover->filename;
                $filepathCoverDatabase = 'storage/files/books/' . $book->id . '/cover/cover' . now()->timestamp . '-' . $temporaryFileCover->filename;
                try {
                    if ($temporaryFileCover) {

                        Storage::copy('public/files/books/temp/' . $request->cover
                            . '/' . $temporaryFileCover->filename, $filepathCover);

                        if (Storage::exists($filepathCover)) {

                            Storage::deleteDirectory('public/files/books/temp/' . $request->cover);
                            Storage::delete(Str::replaceFirst('storage', 'public', $book->cover));

                            $book->cover = $filepathCoverDatabase;

                            $book->save();
                            $temporaryFileCover->delete();

                            $book->themes()->detach();
                            foreach ($request->bookTheme as $theme) {

                                $book->themes()->attach($theme);

                            }

                            $book->ageGroups()->detach();
                            foreach ($request->ageGroup as $ageGroupBook) {

                                $book->ageGroups()->attach($ageGroupBook);


                            }

                            $book->authors()->detach();
                            foreach ($request->author as $bookAuthor) {

                                $book->authors()->attach($bookAuthor);


                            }

                            toastr()->success('The book ' . $book->title . ' was successfully edited.');
                            /*return redirect()->route('books.list');*/
                            return back();

                        } else {
                            toastr()->error('An error has occurred during the edition of the book. Please try again later.');
                            return back();

                        }

                    }
                } catch (\Exception $e) {


                    toastr()->error('An error has occurred during the edition of the book. Please try again later.');
                    return back();
                }

            } elseif (!empty($request->bookPDF) && !empty($request->cover)) {

                $temporaryFileBook = TemporaryFile::where('folder', $request->bookPDF)->first();
                $book->numberPages = $temporaryFileBook->numberPages;

                $filepath = 'public/files/books/' . $book->id . '/' . now()->timestamp . '-' . $temporaryFileBook->filename;
                $filepathDatabase = 'storage/files/books/' . $book->id . '/' . now()->timestamp . '-' . $temporaryFileBook->filename;


                $temporaryFileCover = TemporaryFile::where('folder', $request->cover)->first();

                $filepathCover = 'public/files/books/' . $book->id . '/cover/cover' . now()->timestamp . '-' . $temporaryFileCover->filename;
                $filepathCoverDatabase = 'storage/files/books/' . $book->id . '/cover/cover' . now()->timestamp . '-' . $temporaryFileCover->filename;
                try {
                    if ($temporaryFileCover && $temporaryFileBook) {

                        Storage::copy('public/files/books/temp/' . $request->cover
                            . '/' . $temporaryFileCover->filename, $filepathCover);

                        Storage::copy('public/files/books/temp/' . $request->bookPDF
                            . '/' . $temporaryFileBook->filename, $filepath);

                        if (Storage::exists($filepath) && Storage::exists($filepathCover)) {

                            Storage::deleteDirectory('public/files/books/temp/' . $request->bookPDF);
                            Storage::deleteDirectory('public/files/books/temp/' . $request->cover);

                            Storage::delete(Str::replaceFirst('storage', 'public', $book->book_url));
                            Storage::delete(Str::replaceFirst('storage', 'public', $book->cover));

                            $book->book_url = $filepathDatabase;

                            $book->cover = $filepathCoverDatabase;

                            $book->save();

                            $temporaryFileBook->delete();
                            $temporaryFileCover->delete();

                            $book->themes()->detach();
                            foreach ($request->bookTheme as $theme) {

                                $book->themes()->attach($theme);

                            }

                            $book->ageGroups()->detach();
                            foreach ($request->ageGroup as $ageGroupBook) {

                                $book->ageGroups()->attach($ageGroupBook);


                            }

                            $book->authors()->detach();
                            foreach ($request->author as $bookAuthor) {

                                $book->authors()->attach($bookAuthor);


                            }

                            toastr()->success('The book ' . $book->title . ' was successfully edited.');
                            return back();

                        } else {
                            toastr()->error('An error has occurred during the edition of the book. Please try again later.');
                            return back();

                        }

                    }

                } catch (\Exception $e) {


                    toastr()->error('An error has occurred during the edition of the book. Please try again later.');
                    return back();

                }
            }

        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {

        $book = Book::find($book->id);

        $bookTitle = $book->title;

        try {
            Storage::deleteDirectory('public/files/books/' . $book->id);
            $book->activityTypes()->detach();
            $book->themes()->detach();
            $book->ageGroups()->detach();
            $book->users()->detach();
            $book->authors()->detach();
            $book->delete();
            toastr()->success('The Book ' . $bookTitle . ' was successfully deleted.');
            return back();

        } catch (\Exception $exception) {
            toastr()->error('An error has occurred please try again later.');
            return back();
        }
    }



    public function bookViewer(Book $book)
    {

        $user = auth()->user();

        $countRating=$user->books()->wherePivot('book_id',$book->id)->wherePivotNotNull('rating')->count();

        if($countRating>0){
            $rating=$user->books()->wherePivot('book_id',$book->id)->wherePivotNotNull('rating')->first()->pivot->rating;


        }else{
            $rating=null;
        }



        return view('pages.book-viewer',['book'=>$book,'countRating'=>$countRating,'rating'=>$rating]);

    }


    public function statsBook(Request $request, Book $book)
    {


        $user = auth()->user();



        $checkRating=$user->books()->wherePivot('book_id',$book->id)->wherePivotNotNull('rating')->count();



        if($checkRating==0){

            $this->validate($request, [
                'rate' => 'required|integer|min:1|max:5|',


            ]);


            $user->books()->attach($book->id,['rating'=>$request->rate,'read_date'=>now()]);


        }else{


            $user->books()->attach($book->id,['read_date'=>now()]);


        }

        $this->fillRatingsBookTable();



        return redirect()->route('books-activity',$book);



    }


    public function statsBookEditRating(Request $request, Book $book)
    {



        $user = auth()->user();



        $checkRating=$user->books()->wherePivot('book_id',$book->id)->wherePivotNotNull('rating')->count();



        if($checkRating==1){

            $userPastRating=$user->books()->wherePivot('book_id',$book->id)->wherePivotNotNull('rating')->first();


            $this->validate($request, [
                'rate' => 'required|integer|min:1|max:5|',


            ]);


            $userPastRating->pivot->rating=$request->rate;


            $userPastRating->pivot->save();



            $user->books()->attach($book->id,['read_date'=>now()]);


        }else{


            $user->books()->attach($book->id,['read_date'=>now()]);


        }

        $this->fillRatingsBookTable();



        return redirect()->route('books-activity',$book);



    }

    private function fillRatingsBookTable()
    {


        $books = Book::all();


        foreach ($books as $book) {

            $numberOfReadingsWithRatings[] = $book->users()->wherePivot('book_id', $book->id)->wherePivotNotNull('rating')->count();

            $ratings[] = $book->users()->sum('rating');

        }


        if(isset($ratings)&&isset($numberOfReadingsWithRatings)){


            $averageRatingByBook[] = array_map(function ($a, $b) {

                if ($a!=0&&$b!=0){

                    return round(($a / $b),0);
                } else{

                    return 0;
                }

            }, $ratings, $numberOfReadingsWithRatings);


            $i=0;
            foreach ($books as $book) {

                $book->averageRating=$averageRatingByBook[0][$i];

                $book->save();
                $i=$i+1;

            }


        }


    }

    public function showActivity(Book $book){



        return view('pages.activity',['book'=>$book]);


    }


    public function extractPages($file, $pages)
    {
        $mpdfConfig = [];


        $config = array(
            'format' => 'letter',
            'mode' => 'utf-8',
            'orientation' => 'P',
            'margin_top' => -30,
            'margin_header' => 2,
            'setAutoTopMargin' => 'pad',

        );
        $mpdf = new Mpdf($config);

        $pageCount = $mpdf->setSourceFile($file);
        $pageNumbersToImport = $pages;
        $pageNumbersToImportCount = count($pageNumbersToImport);
// importing pages defined in $pageNumbersToImport
        for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
            if (!in_array($pageNumber, $pageNumbersToImport, true)) {
                continue;
            }

            $templateId = $mpdf->ImportPage($pageNumber); // get page content of page number as template of source pdf file
            $mpdf->UseTemplate($templateId); // add page number of source file to current mpdf generated file

            if ($pageNumber < $pageNumbersToImportCount) {
                $mpdf->AddPage(); // add empty page

            }

        }


        return $mpdf;


    }


}
