<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserPasswordChangeRequest
 * 
 * @property int $id
 * @property int $user_id
 * @property string $url
 * @property Carbon $request_datetime
 * @property Carbon $expiry_datetime
 * @property int $is_active
 * @property Carbon $created_datetime
 * @property int|null $created_by
 * 
 * @property User $user
 *
 * @package App\Models
 */
class UserPasswordChangeRequest extends Model
{
	protected $table = 'user_password_change_requests';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'token' => 'string',
		'url' => 'string',
		'request_datetime' => 'datetime',
		'expiry_datetime' => 'datetime',
		'is_active' => 'int',
		'created_datetime' => 'datetime',
		'created_by' => 'int'
	];

	protected $fillable = [
		'user_id',
		'url',
		'request_datetime',
		'expiry_datetime',
		'is_active',
		'created_datetime',
		'created_by',
		'token'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
