<?php


namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

abstract class Repository
{
    public $pagination = 10;

    /**
     * get table name
     *
     * @return string
     */
    public function getTableName()
    {
        return $this->model->getTable();
    }

    /**
     * set filters in query.
     *
     * @param $query
     *
     * @return object
     */
    public function filters($query, $viewColumnsNames = null)
    {
        if(!is_null($viewColumnsNames))
            $columns = $viewColumnsNames;
        else
            $columns = $this->getTableColumns();
        foreach (request()->all() as $key => $value)
            (in_array($key, $columns)) ? $query = $query->where($key, 'like', '%' . $value . '%') : '';
        $query = $query->orderBy("id", 'desc');

        return $query;
    }

    /**
     * get table columns name
     *
     * @return array
     */
    public function getTableColumns()
    {
        $tableName = $this->getTableName();
        (strpos($tableName, ".") !== false) ? $tableName = explode('.', $tableName)[1] : '';

        return \Schema::getColumnListing($tableName);
    }

    /**
     * Create a new record
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update a record
     *
     * @param array $data
     * @param $id
     *
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }
}
