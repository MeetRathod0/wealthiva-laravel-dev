<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserHerarchy
 * 
 * @property int $id
 * @property int $user_id
 * @property int $parent_id
 * @property Carbon $created_datetime
 * @property Carbon $updated_datetime
 * @property int|null $created_by
 * 
 * @property User $user
 *
 * @package App\Models
 */
class UserHerarchy extends Model
{
	protected $table = 'user_herarchy';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'parent_id' => 'int',
		'created_datetime' => 'datetime',
		'updated_datetime' => 'datetime',
		'created_by' => 'int'
	];

	protected $fillable = [
		'user_id',
		'parent_id',
		'created_datetime',
		'updated_datetime',
		'created_by'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
