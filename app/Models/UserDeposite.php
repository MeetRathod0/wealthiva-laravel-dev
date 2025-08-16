<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserDeposite
 * 
 * @property int $id
 * @property int $user_id
 * @property int $amount
 * @property Carbon $entry_date
 * @property int $is_active
 * @property Carbon $created_datetime
 * @property Carbon $updated_datetime
 * @property int|null $created_by
 * 
 * @property User $user
 *
 * @package App\Models
 */
class UserDeposite extends Model
{
	protected $table = 'user_deposite';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'amount' => 'int',
		'entry_date' => 'datetime',
		'is_active' => 'int',
		'created_datetime' => 'datetime',
		'updated_datetime' => 'datetime',
		'created_by' => 'int'
	];

	protected $fillable = [
		'user_id',
		'amount',
		'entry_date',
		'is_active',
		'created_datetime',
		'updated_datetime',
		'created_by'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
