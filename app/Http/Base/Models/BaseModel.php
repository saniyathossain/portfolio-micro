<?php

namespace App\Http\Base\Models;

use App\Http\Base\Traits\BaseModelTrait;
use App\Http\Base\Traits\EloquentTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * BaseModel class
 */
abstract class BaseModel extends Model
{
    use EloquentTrait,
        BaseModelTrait
        {
            BaseModelTrait::__construct as private __constructBaseModelTrait;
        }

	/**
	 * __construct
	 *
	 * @param  array $attributes
	 *
	 * @return void
	 */
	public function __construct(array $attributes = [])
	{
		$this->__constructBaseModelTrait($attributes);
	}
}
