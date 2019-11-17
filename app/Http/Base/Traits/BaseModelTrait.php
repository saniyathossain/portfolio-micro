<?php

namespace App\Http\Base\Traits;

trait BaseModelTrait
{
	/**
	 * __construct
	 *
	 * @param  array $attributes
	 *
	 * @return void
	 */
	public function __construct(array $attributes = [])
	{
		$this->dateFormat = 'Y-m-d H:i:s.u0';
		$this->guarded    = ['created_by', 'updated_by', 'created_at', 'updated_at'];

		parent::__construct($attributes);
	}

	/**
	 * boot
	 *
	 * @return void
	 */
	public static function boot()
	{
		parent::boot();

		$user_id	= auth()->check() ? auth()->user()->id : null;

		static::creating(function ($model) use ($user_id)
		{
			$model->created_by	= $user_id;
		});

		static::updating(function ($model) use ($user_id)
		{
			$model->updated_by	= $user_id;
		});
	}
}
