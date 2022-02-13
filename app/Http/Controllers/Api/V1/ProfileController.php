<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/*
 * @group Profile
 */
class ProfileController extends Controller
{
    /**
	* Profile
	*
	* Show User profile details
	*
	* @apiResource App\Http\Resources\ProfileResource
    * @apiResourceModel App\Models\User
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
    * @bodyParam name string required Name
	* @bodyParam email string required Email
	* @bodyParam password string optional Password
    *
	* @responseFile responses/profile/update.json
	* @responseFile status=422 scenario="Validation Error" responses/profile/update.validation.json
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request)
    {
        $attributes = $request->validate([
			'name'       => 'required|string',
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
