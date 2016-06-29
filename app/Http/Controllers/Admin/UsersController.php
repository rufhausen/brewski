<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\User as User;

class UsersController extends Controller
{

    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->user->getAll(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int        $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int        $id
     * @return Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->user->find($id);
        $user->update($request->input());

        return view('admin.users.edit', compact('user'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int        $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
