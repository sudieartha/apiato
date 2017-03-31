<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Exceptions\AuthenticationFailedException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Auth\AuthManager as Auth;

/**
 * Class WebLoginTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebLoginTask extends Task
{

    /**
     * @var  \Illuminate\Auth\AuthManager
     */
    private $auth;

    /**
     * WebAuthenticationTask constructor.
     *
     * @param \Illuminate\Auth\AuthManager $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param            $email
     * @param            $password
     * @param bool|false $remember
     *
     * @return  mixed
     */
    public function run($email, $password, $remember = false)
    {
        // if ($remember) {
        //     $remember = true;
        // }
        //
        // $correct = $this->auth->attempt(['email' => $email, 'password' => $password], $remember);
        //
        // if (!$correct) {
        //     throw new AuthenticationFailedException();
        // }
        $user->createToken('Device 1', $scopes, $claims)->accessToken;
        return $this->auth->user();
    }

}
