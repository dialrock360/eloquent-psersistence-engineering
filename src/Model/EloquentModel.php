<?php

namespace dr360\EloquentEngineering\Model;

//use dr360\CodeMaker\Model\ClassModel;
use dr360\CodeMaker\Model\ClassModel;

/**
 * Class EloquentModel
 * @package dr360\EloquentEngineering\Model
 */
class EloquentModel extends ClassModel
{
    /**
     * @var string
     */
    protected $tableName;

    /**
     * @param string $tableName
     *
     * @return $this
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;

        return $this;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }
}
