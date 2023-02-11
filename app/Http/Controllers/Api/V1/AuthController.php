<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use App\Service\Base\ProxyServiceInterface;
use Illuminate\Http\Request;

/**
 * @group Authentication
 */
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'registerUser', 'logout']]);
    }

	/**
	* Login
	*
	* Login into the system.
	*
	* @bodyParam email string required Email Address
	* @bodyParam password string required Password
	*
	* @responseFile responses/authentication/token.post.json
	* @responseFile status=422 responses/authentication/login.post.json
	*
	* @unauthenticated
	*
	* @param \Illuminate\Http\Request $request
	* @param \App\Service\Base\ProxyServiceInterface $proxyService
	* @return \App\Service\Base\ProxyServiceInterface::proxy
	*/
	public function login(Request $request, ProxyServiceInterface $proxyService)
	{
        $attributes = $this->validate($request, [
            'email' 	=> 'required|email',
            'password' 	=> 'required'
        ]);

        return $proxyService->proxy('password', [
			'username' => $attributes['email'],
			'password' => $attributes['password']
		]);
	}

	/**
	* Logout
	*
	* Logout out of the system.
	*
	* @response 200
	* @authenticated
	*/
	public function logout()
	{
		auth()->user()->token()->revoke();
	}

	/**
	 * Register User
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Service\Base\ProxyServiceInterface $proxyService
	 * @return \App\Service\Base\ProxyServiceInterface::proxy
	 */
	public function registerUser(Request $request, ProxyServiceInterface $proxyService)
	{
		$attributes = $request->validate([
			'name'  					=> 'required|string|max:30',
			'username' 	 				=> 'required|string|max:30|unique:users',
			'email' 	 				=> 'required|email|unique:users',
			'password'   				=> 'required|string|min:6|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/'
		], [
            'password.regex' => 'Password must contain at least one letter, one number and one special character.'
        ]);

		$user = new User();
		$user->name  		= $attributes['name'];
		$user->username  	= strtolower($attributes['username']);
		$user->email		= strtolower($attributes['email']);
		$user->password	 	= $attributes['password'];
		$user->save();

		$user->assignRole(User::ROLES['company_admin']);

		return $proxyService->proxy('password', [
			'username' => $attributes['email'],
			'password' => $attributes['password']
		]);
	}


	/**
	 * Register Company
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Service\Base\ProxyServiceInterface $proxyService
	 * @return \App\Service\Base\ProxyServiceInterface::proxy
	 */
	public function registerCompany(Request $request, ProxyServiceInterface $proxyService)
	{
		$attributes = $request->validate([
			'name' 				=> 'required|string',
			'address' 			=> 'required|string',
			'postal_code' 		=> 'required|string',
			'telephone_number' 	=> 'required|string'
		]);

		$company = new Company();
		$company->name 			   = $attributes['name'];
		$company->address 		   = $attributes['address'];
		$company->postal_code 	   = $attributes['postal_code'];
		$company->telephone_number = $attributes['telephone_number'];
		$company->save();

		$user = auth()->user();

		$user->company_id = $company->id;
		$user->save();

		return response()->noContent();
	}
}
