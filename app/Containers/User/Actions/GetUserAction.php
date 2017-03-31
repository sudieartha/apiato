<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\User\Exceptions\UserNotFoundException;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action;
use Auth;

/**
 * Class GetUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetUserAction extends Action
{
    /**
     * @var \App\Containers\User\Tasks\FindUserByIdTask
     */
    private $findUserByIdTask;

    /**
     * @var \App\Containers\Authentication\Tasks\GetAuthenticatedUserTask
     */
    private $getAuthenticatedUserTask;

    /**
     * GetUserAction constructor.
     *
     * @param \App\Containers\User\Tasks\FindUserByIdTask                   $findUserByIdTask
     * @param \App\Containers\Authentication\Tasks\GetAuthenticatedUserTask $getAuthenticatedUserTask
     */
    public function __construct(
        FindUserByIdTask $findUserByIdTask,
        GetAuthenticatedUserTask $getAuthenticatedUserTask
    ) {
        $this->findUserByIdTask = $findUserByIdTask;
        $this->getAuthenticatedUserTask = $getAuthenticatedUserTask;
    }

    /**
     * @param $userId
     *
     * @return  mixed
     * @throws \App\Containers\User\Exceptions\UserNotFoundException
     */
    public function run($userId)
    {
        if ($userId) {

            $user = $this->call(FindUserByIdTask::class, [$userId]);
        } else {
            if (Auth::check()) {
                $user = $this->call(GetAuthenticatedUserTask::class);

            }
        }

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
