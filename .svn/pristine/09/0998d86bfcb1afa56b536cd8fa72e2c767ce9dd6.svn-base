<?php
/**
 * Created by PhpStorm.
 * Author: syhung
 * Date: 11/19/14
 * Time: 5:38 PM
 * cms version 1.0
 *
 */
namespace App\Service;
use Illuminate\Auth\UserProviderInterface,
    Illuminate\Auth\GenericUser,
    Illuminate\Auth\UserInterface,
    Noweb\Cp\User;
use  Illuminate\Hashing\BcryptHasher;
/**
 * Class CerberusUserProvider
 * @package App\Service
 * version : 1.0
 * use system acl
 */
class CerberusUserProvider implements UserProviderInterface{
    private  $userService;
    private  $hasher;
    public  function __construct() {
        $this->userService = new User();
        $this->hasher = new BcryptHasher();
    }
    /**
     * @param mixed $identifier
     * @return bool|GenericUser|UserInterface|null
     */
    public function retrieveByID($identifier) {
        $user = $this->userService->find($identifier);
        if(!$user instanceof User) {
            return false;
        }
        return new GenericUser([
            'id'       => $user->id,
            'username' => $user->username
        ]);
    }
    /**
     * @param mixed $identifier
     * @param string $token
     * @return UserInterface|null
     */
    public function retrieveByToken($identifier, $token){
        $model =  $this->userService;
        return $model->newQuery()
            ->where($model->getKeyName(), $identifier)
            ->where($model->getRememberTokenName(), $token)
            ->first();
    }
    /**
     * @param array $credential
     * @return UserInterface|null|void
     * @ get user by name or email or phone
     */
    public function retrieveByCredentials(array $credentials)
    {
        $credential = isset($credentials['username']) ? $credentials['username'] : (isset($credentials['email']) ? $credentials['email'] : (isset($credentials['phone']) ? $credentials['phone'] : false));
        /*@var $user User */
        $user = $this->userService->getUserByCredentials($credential);
        if(!$user instanceof User)
        {
            return new User();
        }
        return $user;
    }
    /**
     * @param UserInterface $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(UserInterface $user, array $credentials) {
        return $this->hasher->check($credentials['password'], $user->password);
    }
    /**
     * @param UserInterface $user
     * @param string $token
     */
    public function updateRememberToken(UserInterface $user, $token){

    }
}