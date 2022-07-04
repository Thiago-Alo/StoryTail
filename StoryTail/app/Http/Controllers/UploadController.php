<?php

namespace App\Http\Controllers;

use App\TemporaryFile;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;






class UploadController extends Controller
{



    public function storeTempBook(Request $request){


        $this->validate($request, [
            'bookPDF' => 'required|mimes:pdf',

        ]);


        $this->removeTemporaryTrash();


        $pdfBook = file_get_contents($request->file('bookPDF'));
        $numPages = preg_match_all("/\/Page\W/", $pdfBook, $matches);


        if($request->hasfile('bookPDF')){

            try {

                $file=$request->file('bookPDF');
                $fileNameOriginal=$file->getClientOriginalName();
                $fileName=str_replace(' ','',$fileNameOriginal);
                $folder = uniqid().'-'.now()->timestamp;

                $file->storeAs('files/books/temp/'.$folder,$fileName,'public');


                TemporaryFile::create([
                    'folder'=> $folder,
                    'filename'=> $fileName,
                    'numberPages' => $numPages

                ]);


                return $folder;

            } catch (\Exception $exception){

                toastr()->error('An error has occurred during upload. Please try again later.');
                return '';
            }

        }
    }

    public function storeTempCoverBook(Request $request){


        $this->validate($request, [
            'cover' => 'required|mimes:mimes:jpeg,png,jpg,gif,svg,pdf',

        ]);

        $this->removeTemporaryTrash();



        if($request->hasfile('cover')){

            try {

                $file=$request->file('cover');
                $fileNameOriginal=$file->getClientOriginalName();
                $fileName=str_replace(' ','',$fileNameOriginal);
                $folder = uniqid().'-'.now()->timestamp;

                $file->storeAs('files/books/temp/'.$folder,$fileName,'public');

                TemporaryFile::create([
                    'folder'=> $folder,
                    'filename'=> $fileName,

                ]);
                return $folder;

            } catch (\Exception $exception){

                toastr()->error('An error has occurred during upload. Please try again later.');
                return '';
            }






        }


    }

    public function storeTempActivityType(Request $request){


        $this->validate($request, [
            'activityImage' => 'required|mimes:jpeg,png,jpg,gif,svg,jpg',

        ]);



        $this->removeTemporaryTrash();





        if($request->hasfile('activityImage')){


            try {

                $file=$request->file('activityImage');
                $fileNameOriginal=$file->getClientOriginalName();
                $fileName=str_replace(' ','',$fileNameOriginal);
                $folder = uniqid().'-'.now()->timestamp;

                $file->storeAs('files/activity-type/temp/'.$folder,$fileName,'public');

                TemporaryFile::create([
                    'folder'=> $folder,
                    'filename'=> $fileName,

                ]);


                return $folder;

            } catch (\Exception $exception){

                toastr()->error('An error has occurred during upload. Please try again later.');
                return '';
            }






        }


    }



    public function storeTempImageUser(Request $request){


        $this->validate($request, [
            'userImage' => 'required|mimes:jpeg,png,jpg,gif,svg',

        ]);

        $this->removeTemporaryTrash();



        if($request->hasfile('userImage')){


            try {

                $file=$request->file('userImage');
                $fileNameOriginal=$file->getClientOriginalName();
                $fileName=str_replace(' ','',$fileNameOriginal);
                $folder = uniqid().'-'.now()->timestamp;

                $file->storeAs('files/users/temp/'.$folder,$fileName,'public');

                TemporaryFile::create([
                    'folder'=> $folder,
                    'filename'=> $fileName,

                ]);


                return $folder;

            } catch (\Exception $exception){

                toastr()->error('An error has occurred during upload. Please try again later.');
                return '';
            }






        }


    }

    public function storeTempAudio(Request $request){


        $this->validate($request, [
            'bookAudio' => 'required|mimes:audio/mpeg,mpga,mp3,wav,aac,mp4',

        ]);

        $this->removeTemporaryTrash();



        if($request->hasfile('bookAudio')){


            try {

                $file=$request->file('bookAudio');
                $fileNameOriginal=$file->getClientOriginalName();
                $fileName=str_replace(' ','',$fileNameOriginal);
                $folder = uniqid().'-'.now()->timestamp;

                $file->storeAs('files/books/temp/'.$folder,$fileName,'public');

                TemporaryFile::create([
                    'folder'=> $folder,
                    'filename'=> $fileName,

                ]);


                return $folder;

            } catch (\Exception $exception){

                toastr()->error('An error has occurred during upload. Please try again later.');
                return '';
            }






        }


    }




    private function removeTemporaryTrash()
    {
        $temporaryFilesTrash=TemporaryFile::where('created_at','<',Carbon::now()->subHours(2)->toDateTimeString())->count();


        if($temporaryFilesTrash>0){
            $temporaryFilesMoreTwoHours=TemporaryFile::where('created_at','<',Carbon::now()->subHours(2)->toDateTimeString())->get();

            foreach ($temporaryFilesMoreTwoHours as $temporaryFileMoreTwoHour){

                Storage::deleteDirectory('public/files/books/temp/' .  $temporaryFileMoreTwoHour->folder);
                Storage::deleteDirectory('public/files/activity-type/temp/' .  $temporaryFileMoreTwoHour->folder);
                Storage::deleteDirectory('public/files/users/temp/' .  $temporaryFileMoreTwoHour->folder);

                $temporaryFileMoreTwoHour->delete();

            }

        }

    }
}
