<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', auth()->user());

        return new UserResourceCollection(auth()->user()->users()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
			'first_name' => 'required|string',
			'last_name'  => 'required|string',
			'email'      => 'required|email|unique:users',
            'role'       => 'required',
			'password'   => 'required'
		]);

        $this->authorize('create', auth()->user());

        $user = new User();
        $user->first_name  	= $attributes['first_name'];
        $user->last_name  	= $attributes['last_name'];
        $user->email		= $attributes['email'];
        $user->password	    = $attributes['password'];
        $user->company_id 	= auth()->user()->companyId();
        $user->save();

        $user->assignRole(User::ROLES[$attributes['role']]);

        return response()->json([
            'message' => 'Successfully created User.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('view', $user);

        return new UserResource($user);
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
        $attributes = $request->validate([
            'id'         => 'exists:users',
			'first_name' => 'required|string',
			'last_name'  => 'required|string',
            'email'      => [
                'required',
                'email',
                Rule::unique('users')->ignore($id)
            ],
            'role'       => 'required',
			'password'   => 'nullable'
		]);

        $user = User::find($id);

        $this->authorize('update', $user);

        $user->update($attributes);

        return response()->json([
            'message' => 'Successfully updated user.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
