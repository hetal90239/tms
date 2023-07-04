<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Auth;
use App\Models\employee;
class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'empemail' => 'required',
            'password' => 'required|min:6',
        ];
    }
    public function getCredentials()
    {
        // The form field for providing username or password
        // have name of "username", however, in order to support
        // logging users in with both (username and email)
        // we have to check if user has entered one or another
        $empemail = $this->get('empemail');

        if ($this->isEmail($empemail)) {
            return [
                'empemail' => $empemail,
                'password' => $this->get('password')
            ];
        }

        return $this->only('empemail', 'password');
    }
     /**
     * Validate if provided parameter is valid email.
     *
     * @param $param
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function isEmail($param)
    {
        $factory = $this->container->make(ValidationFactory::class);

        return ! $factory->make(
            ['empemail' => $param],
            ['empemail' =>'empemail']
        )->fails();
    }
}


