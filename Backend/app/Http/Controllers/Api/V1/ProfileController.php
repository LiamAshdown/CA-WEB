<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Show Profile Details
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return new ProfileResource(auth()->user());
    }

    /**
     * Update Profile Details
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $attributes = $request->validate([
			'first_name' => 'required|string',
			'last_name'  => 'required|string',
            'email'      => [
                'required',
                'email',
                Rule::unique('users')->ignore(auth()->id())
            ],
            'password' => 'nullable'
		]);

        auth()->user()->update($attributes);

        return response()->json([
            'message' => 'Successfully updated profile.'
        ]);
    }
}
