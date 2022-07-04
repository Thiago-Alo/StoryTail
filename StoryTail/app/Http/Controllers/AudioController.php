<?php

namespace App\Http\Controllers;

use App\Book;
use App\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AudioController extends Controller
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
            $books = Book::orderBy('title')->where('title', 'ilike', '%' . $search . '%')
                ->whereNotNull('audio_url')->paginate(20)->appends('search', $search);

            return view('pages.admin.audio.list', (['books' => $books]));

        }else{

            $books = Book::orderBy('title')->whereNotNull('audio_url')->paginate(20);
            return view('pages.admin.audio.list', ['books' => $books]);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = Book::orderBy('title')->whereNull('audio_url')->get();


        return view('pages.admin.audio.create', ['books' => $books]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'bookId' => 'required|integer|',
            'bookAudio' => 'required|string',

        ]);

        $book = Book::find($request->bookId);




        if ($book->audio_url == null || empty($book->book_url)) {

            try {
                $temporaryFile = TemporaryFile::where('folder', $request->bookAudio)->first();

                $filepath = 'public/files/books/' . $book->id . '/audio/' . now()->timestamp . '-' . $temporaryFile->filename;
                $filepathDatabase = 'storage/files/books/' . $book->id . '/audio/' . now()->timestamp . '-' . $temporaryFile->filename;

                if ($temporaryFile) {

                    Storage::copy('public/files/books/temp/' . $request->bookAudio
                        . '/' . $temporaryFile->filename, $filepath);


                    if (Storage::exists($filepath)) {
                        Storage::deleteDirectory('public/files/books/temp/' . $request->bookAudio);


                        $book->audio_url = $filepathDatabase;

                        $book->save();
                        $temporaryFile->delete();
                        toastr()->success('The audio was successfully created.');
                        return back();
                    } else {

                        toastr()->error('An error has occurred during the creation of the audio. Please try again later.');
                        return back();

                    }
                }
            } catch (\Exception $exception) {
                toastr()->error('An error has occurred during the creation of the audio. Please try again later.');
                return back();

            }

        }else{

            toastr()->info('This book already has an audio. You must first delete it before adding a new one.');
            return back();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {


        $book = Book::find($book->id);


        try {
            Storage::delete(Str::replaceFirst('storage', 'public', $book->audio_url));

            $book->audio_url=null;
            $book->save();
            toastr()->success('The audio was successfully deleted.');
            return back();

        } catch (\Exception $exception) {
            toastr()->error('An error has occurred please try again later.');
            return back();
        }
    }
}
