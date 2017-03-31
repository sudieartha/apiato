<?php

namespace App\Containers\User\UI\API\Transformers;

use App\Containers\Authorization\UI\API\Transformers\RoleTransformer;
use App\Containers\User\Models\User;
use App\Ship\Parents\Transformers\Transformer;
use Carbon\Carbon;
use Config;

/**
 * Class UserTransformer.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserTransformer extends Transformer
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'roles',
    ];

    /**
     * @param \App\Containers\User\Models\User $user
     *
     * @return array
     */
    public function transform(User $user)
    {
        // dd($user);
        // dd(array_key_exists('token',$user['attributes']));
        $response = [
            'object' => 'User',
            'id' => $user->getHashedKey(),
            // 'name' => $user->name,
            'full_name' => $user->fullName(),
            'email' => $user->email,
            'confirmed' => $user->confirmed,
            'nickname' => $user->nickname,
            'gender' => $user->gender,
            'birth' => $user->birth,
            'social_auth_provider' => $user->social_provider,
            'social_id' => $user->social_id,
            'social_avatar' => [
                'avatar' => $user->social_avatar,
                'original' => $user->social_avatar_original,
            ],
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'token' => array_key_exists('token',$user['attributes']) ? $this->transformToken($user->token): null ,
        ];

        $response = $this->ifAdmin([
            'real_id' => $user->id,
            'deleted_at' => $user->deleted_at,
        ], $response);

        return $response;
    }

    // /**
    //  * TODO: remove from here
    //  *
    //  * @param null $token
    //  *
    //  * @return  array
    //  */
    private function transformToken($token = null)
    {
        // dd($token);
        return !$token ? null : [
            'type'       => 'token',
            'token'        => $token,
            'access_token' => [
                'token_type'   => 'Bearer',
                // 'time_to_live' => [
                //     'minutes' => Config::get('jwt.ttl'),
                // ],
                // 'expires_in'   => Carbon::now()->addMinutes(Config::get('jwt.ttl')),
            ],
        ];
    }

    public function includeRoles(User $user)
    {
        return $this->collection($user->roles, new RoleTransformer(), 'role');
    }
}
