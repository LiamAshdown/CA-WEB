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
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
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
	* Register
	*
	* Register into the system.
	*
	* @bodyParam first_name string required First Name
	* @bodyParam last_name string required Last Name
	* @bodyParam email string required Email
	* @bodyParam password string required Password
	* @bodyParam company_name string required Company Name
	* @bodyParam company_telephone_number string required Company Telephone
	* @bodyParam company_postal_code string required Company Postal Code
	* @bodyParam company_address string required Company Address
	*
	* @responseFile responses/authentication/token.post.json
	* @responseFile status=422 responses/authentication/registration.post.json
	*
	* @param \Illuminate\Http\Request $request
	* @param \App\Service\Base\ProxyServiceInterface $proxyService
	* @return \App\Service\Base\ProxyServiceInterface::proxy
	*/
	public function register(Request $request, ProxyServiceInterface $proxyService) 
	{
		$attributes = $request->validate([
			'first_name' 				=> 'required|string',
			'last_name'  				=> 'required|string',
			'email' 	 				=> 'required|email|unique:users',
			'password'   				=> 'required',
			'company_name'				=> 'required|string',
			'company_address' 			=> 'required|string',
			'company_postal_code' 		=> 'required|string',
			'company_telephone_number' 	=> 'required|string',
		]);

		if ($company = Company::create([
			'name' 				=> $attributes['company_name'],
			'address' 			=> $attributes['company_address'],
			'postal_code' 		=> $attributes['company_postal_code'],
			'telephone_number' 	=> $attributes['company_telephone_number']
		])) {
			$user = User::create([
				'first_name' => $attributes['first_name'],
				'last_name'  => $attributes['last_name'],
				'email'		 => $attributes['email'],
				'password'	 => $attributes['password']
			]);

			$user->assignRole(User::ROLES['company_admin']);

			$company->user()->attach($user->id, ['admin' => true]);
		}

		return $proxyService->proxy('password', [
			'username' => $attributes['email'],
			'password' => $attributes['password']
		]);
	}
}
