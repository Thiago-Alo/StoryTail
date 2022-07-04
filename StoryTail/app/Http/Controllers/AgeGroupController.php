<?php

namespace App\Http\Controllers;

use App\AgeGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AgeGroupController extends Controller
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
        return view('pages.admin.age-group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if(empty($request->maximumAge)){
            $this->validate($request, [
                'minimumAge' => 'required|integer|min:0|max:99|',


            ]);


        }else {

            $this->validate($request, [
                'minimumAge' => 'required|integer|min:0|max:99|',
                'maximumAge' => 'integer|min:1|max:99|gt:minimumAge',


            ]);

        }

        if(empty($request->maximumAge)){

            $ageGroup= $request->minimumAge;

        }else{

            $ageGroup= $request->minimumAge ." ".$request->maximumAge;
        }






        $checkAgeGroup = AgeGroup::where('age_group', '=',$ageGroup)->first();

        if($checkAgeGroup===null){

            $newAgeGroup = new AgeGroup();

            $newAgeGroup->age_group = $ageGroup;

            if($newAgeGroup->save()){

                toastr()->success('The age range ' . $request->minimumAge.'-'.$request->maximumAge. ' was successfully created.');
                return back();
            } else{

                toastr()->error('An error has occurred during the creation of the age range. Please try again later.');
                return back();
            }



        } else{

            toastr()->error('This age range has already been taken.');
            return back();

        }









        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AgeGroup  $ageGroup
     * @return \Illuminate\Http\Response
     */
    public function show(AgeGroup $ageGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AgeGroup  $ageGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(AgeGroup $ageGroup)
    {


        return view('pages.admin.age-group.edit', [ 'ageGroup' => $ageGroup]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AgeGroup  $ageGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AgeGroup $ageGroup)
    {
        if(empty($request->maximumAge)){
            $this->validate($request, [
                'minimumAge' => 'required|integer|min:0|max:99|',


            ]);


        }else {

            $this->validate($request, [
                'minimumAge' => 'required|integer|min:0|max:99|',
                'maximumAge' => 'integer|min:1|max:99|gt:minimumAge',


            ]);

        }


        if(empty($request->maximumAge)){

            $ageGroupFormat= $request->minimumAge;

        }else{

            $ageGroupFormat= $request->minimumAge ." ".$request->maximumAge;
        }




        $checkAgeGroup = AgeGroup::where('age_group', '=',$ageGroupFormat)->first();

        if($checkAgeGroup===null){


            $ageGroup->age_group = $ageGroupFormat;

            if($ageGroup->save()){

                toastr()->success('The age range was successfully edited.');
                return back();
            } else{

                toastr()->error('An error has occurred during the edition of the age range. Please try again later.');
                return back();
            }



        } else{

            toastr()->error('This age range has already been taken.');
            return back();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AgeGroup  $ageGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(AgeGroup $ageGroup)
    {

        $checkIfExistsBooks = $ageGroup->books()->wherePivot('age_group_id', $ageGroup->id)->exists();

        if (!$checkIfExistsBooks) {

            $ageGroupName = $ageGroup->age_group;

            try {
                $ageGroup->books()->detach();
                $ageGroup->delete();
                toastr()->success('The age group ' . $ageGroupName . ' was successfully deleted.');
                return back();

            } catch (\Exception $exception) {
                toastr()->error('An error has occurred please try again later.');
                return back();
            }

        } else {
            toastr()->error('This age group is linked to books. To delete it you must first remove this age group from books.');
            return back();

        }
    }
}
