<?php

/**
 * @apiGroup           Users
 * @apiName            DeleteUser
 * @api                {delete} /users/:id Delete User (admin, client..)
 * @apiDescription     Delete Users of any type (Admin, Client,...)
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 OK
{
    "message": "User (4) Deleted Successfully."
}
 */

Route::delete('users/{id}', [
    'uses'       => 'Controller@deleteUser',
    'middleware' => [
        'auth:api',
    ],
]);
