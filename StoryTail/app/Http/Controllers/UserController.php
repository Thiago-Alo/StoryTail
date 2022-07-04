<?php

namespace App\Http\Controllers;

use App\Book;
use App\Notifications\ActiveUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {


        if ($request->has('search') && $request->get('search') != null) {

            $users = User::where('name', 'ilike', '%' . $request->search . '%')
                ->orWhere('email', 'ilike', '%' . $request->search . '%')->paginate(20)->appends('search', $request->search);
            return view('pages.admin.users.list', (['users' => $users]));

        }


        if ($request->has('orderby')) {

            try {

                $column = Str::beforeLast($request->orderby, '_');
                $order = Str::afterLast($request->orderby, '_');

                $users = User::orderBy($column, $order)
                    ->whereNotNull($column)->paginate(20)->appends('orderby', $request->orderby);


                return view('pages.admin.users.list', ['users' => $users]);


            } catch (\Exception $e) {
                $users = User::orderBy('name')->paginate(20);
                return view('pages.admin.users.list', ['users' => $users]);

            }

        } else {

            $users = User::orderBy('name')->paginate(20);
            return view('pages.admin.users.list', ['users' => $users]);
        }


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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $username = $user->name;

        try {
            $user->delete();
            toastr()->success('User ' . $username . ' was successfully deleted.');
            return back();

        } catch (\Exception $exception) {
            toastr()->error('An error has occurred please try again later.');
            return back();
        }
    }

    public function redirectTo()
    {

        if (auth()->check() && !auth()->user()->active) {
            return view('auth.validation');
        }
        return redirect()->route('home');
    }

    public function activeUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'active' => 'required|boolean'

        ]);

        $user = User::find($id);

        try {
            $user->active = $request->active;
            $user->save();
            toastr()->success('User status has been updated.');
            if ($request->active == 1) {
                Notification::route('mail', $user->email)->notify(new ActiveUser($user));
            }

            return back();
        } catch (\Exception $exception) {
            toastr()->error('An error has occurred please try again later.');
            return back();
        }

    }

    public function roleUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'userType' => 'required|between:1,2|numeric'

        ]);


        $user = User::find($id);

        try {
            $user->account_type_id = $request->userType;
            $user->save();
            $userType = $user->accountType->type;
            toastr()->success('User role has been updated to ' . $userType . '.');

            return back();
        } catch (\Exception $exception) {
            toastr()->error('An error has occurred please try again later.');
            return back();
        }

    }

    public function userFavourites(Request $request,Book $book)
    {



        $user = auth()->user();

        $userBook = $user->books()
            ->wherePivot('book_id', $book->id)
            ->wherePivotNotNull('read_date')
            ->get();

        $userBookCount = $user->books()
            ->wherePivot('book_id', $book->id)
            ->wherePivotNotNull('read_date')
            ->count();



        if ($userBookCount == 0) {

            toastr()->info('To put the book as a favourite, you first have to read it...');
            return back();

        } else {
            foreach ($userBook as $userBookRead) {


            if ($request->userFavourite==='false') {
                $userBookRead->pivot->is_favourite = false;
                $userBookRead->pivot->save();

            } else {

                if($request->userFavourite==='true') {

                if($user->books()
                    ->wherePivot('book_id', $book->id)
                    ->wherePivot('is_favourite', true)
                    ->wherePivotNotNull('read_date')
                    ->count()==0){

                    $userBookRead->pivot->is_favourite = true;
                    $userBookRead->pivot->save();
                }

                }

            }

            }
            return back();

        }


    }


}
