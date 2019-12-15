<?php


namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

abstract class Repository
{
    public $pagination = 10;
    protected $model;
    protected $columns = array('*');


    public function __construct()
    {
        $this->model = $this->setModelName();
    }

    abstract function setModelName();

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

    /**
     * Get record by some other attribute
     *
     * @param $field
     * @param $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findBy($field, $value, $columns = null)
    {
        $columns = $this->setColumns($columns);
        return $this->model->where($field, '=', $value)->first($columns);
    }

    /**
     * check and set data in columus array
     *
     * @param array $columns
     *
     * @return array
     */
    private function setColumns($columns)
    {
        if ($columns == null)
            return $columns = $this->columns;
        else
            return $columns;
    }
}
