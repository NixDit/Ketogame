<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'       => ['required', 'string', 'max:255'],
            'lastname'   => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'   => ['required', 'string', 'min:8'],
            'mobile'     => ['required', 'string', 'max:12','unique:users'],
            'country_id' => ['required', 'integer'],
        ], $this->messages());
    }

    public function messages()
    {
        return [
            'name.required'       => 'Favor de escribir su(s) nombre(s)',
            'lastname.required'   => 'Favor de escribir su apellido(s)',
            'email.required'      => 'Favor de escribir su correo',
            'email.unique'        => 'El correo ingresado ya existe',
            'password.required'   => 'Favor de escribir un password',
            'password.min'        => 'Su password debe tener almenos 8 caracteres',
            'mobile.required'     => 'Favor de ingresar su telefono',
            'mobile.max'          => 'Su telefono debe tener maximo 12 numeros',
            'mobile.unique'       => 'Este telefono ya ha sido registrado',
            'mobile.integer'      => 'Solo se aceptan numeros',
            'country_id.required' => 'Favor de seleccionar su pais'
        ];
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name'       => ucwords(strtolower($data['name'])),
            'lastname'   => ucwords(strtolower($data['lastname'])),
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'mobile'     => $data['mobile'],
            'country_id' => $data['country_id']
        ]);
        $user->assignRole('guest');

        return $user;
    }
}
