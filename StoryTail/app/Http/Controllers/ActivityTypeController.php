<?php

namespace App\Http\Controllers;

use App\ActivityType;
use App\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ActivityTypeController extends Controller
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
        return view('pages.admin.activity-type.create');
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
            'theme' => 'required|max:50|unique:activity_types,type',
            'activityImage' => 'required|string',

        ]);


        $activityType = new ActivityType();

        try {
            $temporaryFile = TemporaryFile::where('folder', $request->activityImage)->first();


            $activityType->type=$request->theme;

            $activityType->save();

            $filepath = 'public/files/activity-type/' . $activityType->id . '/' . now()->timestamp . '-' . $temporaryFile->filename;
            $filepathDatabase = 'storage/files/activity-type/' . $activityType->id . '/' . now()->timestamp . '-' . $temporaryFile->filename;

            if ($temporaryFile) {


                Storage::copy('public/files/activity-type/temp/' . $request->activityImage
                    . '/' . $temporaryFile->filename, $filepath);

                if (Storage::exists($filepath)) {
                    Storage::deleteDirectory('public/files/activity-type/temp/' . $request->activityImage);
                    $activityType->activity_image = $filepathDatabase;


                    $activityType->save();
                    $temporaryFile->delete();
                    toastr()->success('The activity theme ' . $activityType->type . ' was successfully created.');
                    return back();

            }else {
                    $activityType->forceDelete();
                    toastr()->error('An error has occurred during the creation of the activity theme. Please try again later.');
                    return back();
        }
        }
        }catch (\Exception $exception) {
            $activityType->forceDelete();
            toastr()->error('An error has occurred during creation of the activity theme. Please try again later.');
            return back();


    }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ActivityType  $activityType
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityType $activityType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ActivityType  $activityType
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivityType $activityType)
    {
        return view('pages.admin.activity-type.edit', [ 'activityType' => $activityType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ActivityType  $activityType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActivityType $activityType)
    {
        $request['theme']=ucwords($request->theme);


        if($request['theme']==$activityType->type&&empty($request->activityImage)){

            return back();

        }elseif ($request['theme']!=$activityType->type&&empty($request->activityImage)){

            $this->validate($request, [
                'theme' => 'required|max:50|unique:activity_types,type',


            ]);

            $activityType->type=$request->theme;

            if($activityType->save()){

                toastr()->success('The activity theme was successfully edited.');
                return back();

            }else{
                toastr()->error('An error has occurred during the edition of the activity. Please try again later.');
                return back();

            }


        }elseif ($request['theme']==$activityType->type&&!empty($request->activityImage)){

            $this->validate($request, [
                'activityImage' => 'required|string',


            ]);

            $temporaryFile = TemporaryFile::where('folder', $request->activityImage)->first();

            $filepath = 'public/files/activity-type/' . $activityType->id . '/' . now()->timestamp . '-' . $temporaryFile->filename;
            $filepathDatabase = 'storage/files/activity-type/' . $activityType->id . '/' . now()->timestamp . '-' . $temporaryFile->filename;

            try {
            if ($temporaryFile) {
                Storage::copy('public/files/activity-type/temp/' . $request->activityImage
                    . '/' . $temporaryFile->filename, $filepath);


                if (Storage::exists($filepath)) {

                    Storage::deleteDirectory('public/files/activity-type/temp/' . $request->activityImage);
                    Storage::delete(Str::replaceFirst('storage', 'public', $activityType->activity_image));

                    $activityType->activity_image=$filepathDatabase;
                    $activityType->save();
                    $temporaryFile->delete();
                    toastr()->success('The activity theme ' . $activityType->type . ' was successfully edited.');
                    return back();

                }else{
                    toastr()->error('An error has occurred during the edition of the activity. Please try again later.');
                    return back();

                }

            }

            } catch (\Exception $e) {


                toastr()->error('An error has occurred during the edition of the activity. Please try again later.');
                return back();

            }

        }elseif ($request['theme']!=$activityType->type&&!empty($request->activityImage)){

            $this->validate($request, [
                'activityImage' => 'required|string',
                'theme' => 'required|max:50|unique:activity_types,type',


            ]);

            $activityType->type=$request->theme;
            $activityType->save();


            $temporaryFile = TemporaryFile::where('folder', $request->activityImage)->first();

            $filepath = 'public/files/activity-type/' . $activityType->id . '/' . now()->timestamp . '-' . $temporaryFile->filename;
            $filepathDatabase = 'storage/files/activity-type/' . $activityType->id . '/' . now()->timestamp . '-' . $temporaryFile->filename;

            try {
                if ($temporaryFile) {
                    Storage::copy('public/files/activity-type/temp/' . $request->activityImage
                        . '/' . $temporaryFile->filename, $filepath);


                    if (Storage::exists($filepath)) {

                        Storage::deleteDirectory('public/files/activity-type/temp/' . $request->activityImage);
                        Storage::delete(Str::replaceFirst('storage', 'public', $activityType->activity_image));

                        $activityType->activity_image=$filepathDatabase;
                        $activityType->save();
                        $temporaryFile->delete();
                        toastr()->success('The activity theme ' . $activityType->type . ' was successfully edited.');
                        return back();

                    }else{
                        toastr()->error('An error has occurred during the edition of the activity. Please try again later.');
                        return back();

                    }

                }

            } catch (\Exception $e) {


                toastr()->error('An error has occurred during the edition of the activity. Please try again later.');
                return back();

            }


        }
        return back();



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ActivityType  $activityType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityType $activityType)
    {

        $checkIfExistsBooks = $activityType->books()->wherePivot('activity_type_id', $activityType->id)->exists();

        if (!$checkIfExistsBooks) {

        $activityTypeName = $activityType->type;

        try {
            Storage::deleteDirectory('public/files/activity-type/' . $activityType->id);
            $activityType->books()->detach();
            $activityType->delete();
            toastr()->success('The activity theme ' . $activityTypeName . ' was successfully deleted.');
            return back();

        } catch (\Exception $exception) {
            toastr()->error('An error has occurred please try again later.');
            return back();
        }
        } else {
            toastr()->error('This activity theme is linked to books. To delete it you must first remove this activity from books.');
            return back();

        }

}
}
