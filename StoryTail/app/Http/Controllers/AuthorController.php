<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['name']=ucwords($request->name);


        $this->validate($request, [
            'name' => 'required|max:50|unique:authors,name',


        ]);
        $author = new Author();
        $author->name = $request->name;
        if($author->save()){
            toastr()->success('The author ' . $author->name . ' was successfully created.');
            return back();

        } else {

            toastr()->error('An error has occurred during the creation of the author. Please try again later.');
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
    public function edit(Author $author)
    {
        return view('pages.admin.authors.edit', [ 'author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {



        $request['name']=ucwords($request->name);

        $checkAuthor = Author::where('name', '=',$request['name'])->first();

        if($checkAuthor===null){



        $this->validate($request, [
            'name' => 'required|max:50',


        ]);
        $author->name = $request->name;
        if($author->save()){
            toastr()->success('The author was successfully edited.');
            return back();

        } else {

            toastr()->error('An error has occurred during the edition of the author. Please try again later.');
            return back();
        }

        }else{

            toastr()->error('This author has already been taken.');
            return back();
        }




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $checkIfExistsBooks = $author->books()->wherePivot('author_id', $author->id)->exists();

        if (!$checkIfExistsBooks) {

            $authorName = $author->name;

            try {
                $author->books()->detach();
                $author->delete();
                toastr()->success('The author ' . $authorName . ' was successfully deleted.');
                return back();

            } catch (\Exception $exception) {
                toastr()->error('An error has occurred please try again later.');
                return back();
            }

        } else {
            toastr()->error('This author is linked to books. To delete it you must first remove this author from books.');
            return back();

        }
    }
}
