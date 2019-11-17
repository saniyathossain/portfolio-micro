<?php

namespace App\Http\Base\Traits;

use Schema;

/**
* EloquentTrait is used for common eloquent queries which can be used
* in eloquent extended models for commonly used sql operations
*
* @author Saniyat Hossain <saniyat1000@gmail.com>
*/
trait EloquentTrait
{
	/**
	 * getColumnIndentifiers
	 *
	 * @param  string $column
	 * @param  string $alias
	 *
	 * @return string
	 */
	public function getColumnIndentifiers(string $column, string $alias = ''): string
	{
		return !empty($alias) ? sprintf('%s as %s', $column, $alias) : $column;
	}

    /**
     * getColumns
     *
     * Get Column List of a Database Table - With Table Name (e.g. table_name.column_name) as array
     *
     * @param  array  $unselects [optional parameter - array of column names to be excluded in the list]
     * @return array             [array of desired column names of a database table]
     * @author saniyat hossian   <saniyat1000@gmail.com>
     * @return array
     */
	public function getColumns(array $unselects = []): array
	{
		$table	= $this->getTable();
		$query	= Schema::getColumnListing($table);

		array_walk($query, function (&$select) use ($table)
		{
			$select	= $table.'.'.$select;
		});

		if (!empty($unselects)):
			$query	= array_diff($query, $unselects);
		endif;

		return $query;
	}

	/**
	 * generateCaseSql
	 *
	 * @param  array $input
	 * @param  string $table
	 * @param  string $field
	 * @param  string $alias
	 *
	 * @return string
	 */
	public function generateCaseSql(array $input, string $table, string $field, string $alias = ''): string
	{
		if (empty($alias)):
			$alias	= $field;
		endif;

		$sql = 'case '.$table.'.'.$field.' ';

		foreach ($input as $key => $value):
			$sql .= 'when \''.$key.'\' then \''.$value.'\' ';
		endforeach;

		$sql .= 'else \'\' end as '.$alias;

		return $sql;
	}
}
