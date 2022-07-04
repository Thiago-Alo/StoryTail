<?php

namespace App\Http\Controllers;

use App\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MyaccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();

        $userLastBookRead = $user->books()->orderBy('read_date', 'Desc')->first()->title;

        $userFavouritesBooks = $user->books()->wherePivot('is_favourite', true)->get();


        return view('pages.my-account', ['userLastBookRead' => $userLastBookRead, 'userFavouritesBooks' => $userFavouritesBooks]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = auth()->user();

        $request['name'] = ucwords($request->name);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:50'],
            'age' => ['required', 'date'],


        ]);
        $user->name = $request->name;
        $user->age = $request->age;

        if (empty($request->userImage)) {
            if ($user->save()) {
                toastr()->success('Your profile was successfully edited.');
                return back();

            } else {

                toastr()->error('An error has occurred during the edition of your profile. Please try again later.');
                return back();
            }

        } else {

            $this->validate($request, [
                'userImage' => 'required|string',


            ]);

            $temporaryFile = TemporaryFile::where('folder', $request->userImage)->first();

            $filepath = 'public/files/users/' . $user->id . '/' . now()->timestamp . '-' . $temporaryFile->filename;
            $filepathDatabase = 'storage/files/users/' . $user->id . '/' . now()->timestamp . '-' . $temporaryFile->filename;

            try {

                if ($temporaryFile) {
                    Storage::copy('public/files/users/temp/' . $request->userImage
                        . '/' . $temporaryFile->filename, $filepath);


                    if (Storage::exists($filepath)) {
                        Storage::deleteDirectory('public/files/users/temp/' . $request->userImage);
                        Storage::delete(Str::replaceFirst('storage', 'public', $user->photo));

                        $user->photo = $filepathDatabase;
                        $user->save();
                        $temporaryFile->delete();
                        toastr()->success('Your profile was successfully edited.');
                        return back();

                    } else {
                        toastr()->error('An error has occurred during the edition of your profile. Please try again later.');
                        return back();

                    }


                }

            } catch (\Exception $e) {


                toastr()->error('An error has occurred during the edition of your profile. Please try again later.');
                return back();
            }
        }

        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
