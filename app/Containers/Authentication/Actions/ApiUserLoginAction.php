<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\ApiLoginWithCredentialsTask;
use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Ship\Engine\Butlers\Facades\Call;
use App\Ship\Parents\Actions\Action;
use Illuminate\Http\Request;
/**
 * Class ApiUserLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiUserLoginAction extends Action
{
    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function run(Request $request)
    {

        $token = $this->call(ApiLoginWithCredentialsTask::class, [$request]);

        $user = $this->call(GetAuthenticatedUserTask::class);

        $user->token = $token;

        return $user;
    }
}
