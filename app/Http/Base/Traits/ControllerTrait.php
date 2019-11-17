<?php

namespace App\Http\Base\Traits;

use Illuminate\Pagination\LengthAwarePaginator;

/**
* Controller Trait is used for common controller methods which can be used
* in controllers for commonly used operations
*
* @author Saniyat Hossain <saniyat1000@gmail.com>
*/
trait ControllerTrait
{
    /**
     * paginateResult
     *
     * @param array $result
     * @param int   $perPage
     *
     * @return \lluminate\Pagination\LengthAwarePaginator
     */
	protected function paginateResult(array $result, int $perPage = 10)
	{
		$page		= request()->input('page', 1);
		$offset		= ($page * $perPage) - $perPage;

		return new LengthAwarePaginator(
            $this->transformResult($result, $offset, $perPage),
            count($result),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query()
            ]
        );
	}

    /**
     * transformResult
     *
     * @param array $result
     * @param int $offset
     * @param int $perPage
     *
     * @return array
     */
	private function transformResult($result, $offset, $perPage)
	{
		$result	= array_slice($result, $offset, $perPage, true);

		// return $this->transformer->toResult(collect($result));
		return collect($result);
	}
}
