<?php

namespace App\Http\Base\Models;

use App\Http\Base\Traits\BaseModelTrait;
use App\Http\Base\Traits\EloquentTrait;
use Eloquent;

/**
 * BaseModel class
 */
abstract class BaseModel extends Eloquent
{
    use EloquentTrait,
        BaseModelTrait
        {
            BaseModelTrait::__construct as protected __constructBaseModelTrait;
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
