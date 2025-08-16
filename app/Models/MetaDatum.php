<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MetaDatum
 * 
 * @property int $id
 * @property string $mkey
 * @property string $mvalue
 * @property int $is_active
 * @property Carbon $created_datetime
 * @property Carbon $updated_datetime
 * @property int|null $created_by
 *
 * @package App\Models
 */
class MetaDatum extends Model
{
	protected $table = 'meta_data';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'int',
		'created_datetime' => 'datetime',
		'updated_datetime' => 'datetime',
		'created_by' => 'int'
	];

	protected $fillable = [
		'mkey',
		'mvalue',
		'is_active',
		'created_datetime',
		'updated_datetime',
		'created_by'
	];
}
