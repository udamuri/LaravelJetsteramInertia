<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patient extends Model
{
    use HasFactory;

	protected $fillable = [
        'name',
        'patientid',
        'address',
        'rtrw',
        'phone',
        'birth_date',
        'gender',
        'village_id',
    ];

    public $timestamps = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $appends = [
        'formattedCreatedAt',
        'formattedUpdatedAt',
    ];

	public function village()
    {
        return $this->hasOne(Village::class, 'id', 'village_id');
    }

    public function getFormattedCreatedAtAttribute($value)
    {
        return Carbon::parse($this->created_at)->format('d M Y H:i:s');
    }
	
	public function getFormattedUpdatedAtAttribute($value)
    {
        return Carbon::parse($this->updated_at)->format('d M Y H:i:s');
    }
	
    public function scopeWhereSearch($query, $search)
    {
        foreach (explode(' ', $search) as $term) {
            $query->where('patients.name', 'LIKE', '%'.$term.'%')
				->orWhere('patients.address', 'LIKE', '%'.$term.'%')
				->orWhere('patients.phone', 'LIKE', '%'.$term.'%');
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

    public static function createWebapp($request) {
        $data = $request->validated();
		
        if($create = Patient::create($data)) {
			$id = Carbon::now()->isoFormat('YYMM') . sprintf('%06d', $create->id);
			$create->patientid = $id;
			$create->save();
		}
		
        return $create;
    }

    public function updateWebapp($request) {
        $data = $request->validated();
		
        if($this->update($data)) {
			//
		}

        return $this ?? [];
    }
}
