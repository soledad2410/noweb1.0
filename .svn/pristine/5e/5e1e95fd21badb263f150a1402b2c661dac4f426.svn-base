<?php
namespace Noweb\Cp;
use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Auth\UserTrait;
use \Illuminate\Auth\UserInterface;
use \Illuminate\Auth\Reminders\RemindableTrait;
use \Illuminate\Auth\Reminders\RemindableInterface;


class User extends BaseModel implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function group()
    {

        return $this->hasOne('\Noweb\Cp\Group','id','group_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function city()
    {
        return $this->hasOne('\Noweb\Cp\City','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function district()
    {
        return $this->hasOne('\Noweb\Cp\District','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function domain()
    {
        return $this->hasOne('Noweb\Cp\Domain','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany('\Noweb\Cp\Activity','user_id');
    }

    public function getAvatar()
    {
        $urlService = new \App\Service\URLService($this);
        return $urlService->getAvatarUrl();
    }

    /**
     * @param $credential
     * Get user by phone or email or username
     */
    public function getUserByCredentials($credential)
    {
        $user = \DB::table($this->table)->select('users.id')
                ->where(function($query)
                    {
                        $query->where('users.active',1)
                             ->where('groups.active',1);
                    })
                ->where('username',$credential)
                ->orwhere('email',$credential)
                ->orwhere('phone',$credential)
                ->join('groups','users.group_id','=','groups.id')
                ->first();

        if($user) {
          return $this->find($user->id);
        }
    }

    public function deleteUser()
    {
        /** Delete activities records */
         \DB::table('user_activities')->where('user_id','=',$this->id)->delete();
        return $this->delete();

    }

    /**
     * @return bool
     */
    public function updateLoginLogs()
    {
        $domainService = new DomainService();
        $domain_id = $domainService->getDomain()->id;
        $insertArray = array(
            'user_id' => $this->id,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'logged_time' => date('Y-m-d H:i:s'),
            'platform' => getCurrentPlatform(),
            'domain_id' => $domain_id
        );
        return \DB::table('user_activities')->insert($insertArray);
    }
}
