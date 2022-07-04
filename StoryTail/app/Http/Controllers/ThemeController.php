<?php

namespace App\Http\Controllers;

use App\Book;
use App\Theme;
use Illuminate\Http\Request;
use Storage;

class ThemeController extends Controller
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
        return view('pages.admin.themes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['theme']=ucwords($request->theme);

        $this->validate($request, [
            'theme' => 'required|max:40|unique:themes,name',


        ]);

        $theme = new Theme();
        $theme->name = $request->theme;
        if($theme->save()){
            toastr()->success('The book theme ' . $theme->name . ' was successfully created.');
            return back();

        } else {

            toastr()->error('An error has occurred during the creation of the author. Please try again later.');
            return back();
        }


        return back();




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function show(Theme $theme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function edit(Theme $theme)
    {
        return view('pages.admin.themes.edit', [ 'theme' => $theme]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Theme $theme)
    {
        $request['theme']=ucwords($request->theme);


        $checkTheme = Theme::where('name', '=',$request['theme'])->first();

        if($checkTheme===null){



        $this->validate($request, [
            'theme' => 'required|max:40',


        ]);

        $theme->name = $request->theme;
        if($theme->save()){
            toastr()->success('The book theme ' . $theme->name . ' was successfully created.');
            return back();

        } else {

            toastr()->error('An error has occurred during the creation of the author. Please try again later.');
            return back();
        }

        }else{
            toastr()->error('This book theme has already been taken.');
            return back();

        }


        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theme $theme)
    {

        $checkIfExistsBooks = $theme->books()->wherePivot('theme_id', $theme->id)->exists();


        if (!$checkIfExistsBooks) {

            $themeName = $theme->name;

            try {
                $theme->books()->detach();
                $theme->delete();
                toastr()->success('The Book Theme ' . $themeName . ' was successfully deleted.');
                return back();

            } catch (\Exception $exception) {
                toastr()->error('An error has occurred please try again later.');
                return back();
            }

        } else {
            toastr()->error('This theme is linked to books. To delete it you must first remove this theme from books.');
            return back();

        }
    }

}
