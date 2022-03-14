<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use File;
use Intervention\Image\Facades\Image as Image;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
		'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'is_active',
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'formattedCreatedAt',
        'formattedUpdatedAt',
        'isOperator',
        'photoProfile',
        'isSuperAdmin',
    ];

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function getIsOperatorAttribute($value)
    {
        $permission = ['operator', 'super-admin'];
        if(in_array($this->role, $permission)) {
            return true;
        }

        return false;
    }

    public function getIsSuperAdminAttribute($value)
    {
        $permission = ['super-admin'];
        if(in_array($this->role, $permission)) {
            return true;
        }

        return false;
    }
		

    public function getPhotoProfileAttribute($value)
    {
		if ( $this->profile_photo_path != null && Storage::disk('local')->exists('public/' . $this->profile_photo_path)) {
			return asset('storage/' . $this->profile_photo_path . '?' . time());
		} else {
			return asset('images/brother-in-law.png?' . time());
		}
    }
	
	public function getFormattedCreatedAtAttribute($value)
    {
        return Carbon::parse($this->created_at)->format('d M Y H:i:s');
    }
        
    public function getFormattedUpdatedAtAttribute($value)
    {
        return Carbon::parse($this->updated_at)->format('d M Y H:i:s');
    }

    

	public function scopeWhereUserId($query, $user_id)
    {
        $query->where('users.id', $user_id);
    }
	
	public function scopeWhereRole($query, $search)
    {
        $query->where('users.role', $search);
    }

    public function scopeWhereRoleIn($query, $search = [])
    {
        $query->whereIn('users.role', $search);
    }

    public function scopeWhereSearch($query, $search)
    {
        foreach (explode(' ', $search) as $term) {
            $query->where('users.name', 'LIKE', '%'.$term.'%')
                ->orWhere('users.email', 'LIKE', '%'.$term.'%');
        }
    }
    
    public function scopeApplyFilters($query, array $filters)
    {
        $filters = collect($filters);
        if ($filters->get('search')) {
            $query->whereSearch($filters->get('search'));
        }
    }

    public function scopePaginateData($query, $limit)
    {
        if ($limit == 'all') {
            return collect(['data' => $query->get()]);
        }

        return $query->paginate($limit);
    }

    public static function createUser($request) {        
        $data = $request;

        $data['password'] = Hash::make($data['password']);

        $user = self::create($data);

		if(isset($data['role']) && $data['role'] == 'bank') {
			$user->user_bank()->create($data);
		}

        return $user;
    }

    public function updateUser($request) {
        $data = $request;
        
        if(isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $this->update($data);

        return $this;
    }

	
	public static function updatePhoto($request) {
		$user_id = Auth::user()->id;
		$model = User::find($user_id);

        if ($request->hasFile('photo')) {
			Storage::disk('public')->delete($model->profile_photo_path);
			$file = $request->file('photo');
			$filename = md5($model->id) . '.' . $file->getClientOriginalExtension();
			$file->storeAs('public/profile-photos/', $filename);

			$model->profile_photo_path = 'profile-photos/' . $filename;
			$model->save();

			return true;
		}
        
        return false;
    }

	public static function logout($request) {
		$replace = str_replace("Bearer ", "", $request->header('authorization'));
		$explode = explode("|", $replace);
		
		if($request->input('type') == 'all') {
			Auth::user()->tokens()->delete();
		} else {
			if(isset($explode[0])) {
				Auth::user()->tokens()->where('id', $explode[0])->delete();
			}
		}
	}
}
