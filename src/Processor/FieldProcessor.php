<?php

namespace dr360\EloquentEngineering\Processor;

use dr360\CodeMaker\Model\DocBlockModel;
use dr360\CodeMaker\Model\PropertyModel;
use Illuminate\Database\DatabaseManager;
use dr360\EloquentEngineering\Config;
use dr360\EloquentEngineering\Model\EloquentModel;
use dr360\EloquentEngineering\TypeRegistry;
use dr360\CodeMaker\Model\VirtualPropertyModel;

/**
 * Class FieldProcessor
 * @package dr360\EloquentEngineering\Processor
 */
class FieldProcessor implements ProcessorInterface
{
    /**
     * @var DatabaseManager
     */
    protected $databaseManager;

    /**
     * @var TypeRegistry
     */
    protected $typeRegistry;

    /**
     * FieldProcessor constructor.
     * @param DatabaseManager $databaseManager
     * @param TypeRegistry $typeRegistry
     */
    public function __construct(DatabaseManager $databaseManager, TypeRegistry $typeRegistry)
    {
        $this->databaseManager = $databaseManager;
        $this->typeRegistry = $typeRegistry;
    }

    /**
     * @inheritdoc
     */
    public function process(EloquentModel $model, Config $config)
    {
        $schemaManager = $this->databaseManager->connection($config->get('connection'))->getDoctrineSchemaManager();
        $prefix        = $this->databaseManager->connection($config->get('connection'))->getTablePrefix();

        $tableDetails       = $schemaManager->listTableDetails($prefix . $model->getTableName());
        $primaryColumnNames = $tableDetails->getPrimaryKey() ? $tableDetails->getPrimaryKey()->getColumns() : [];

        $columnNames = [];
        foreach ($tableDetails->getColumns() as $column) {
            $model->addProperty(new VirtualPropertyModel(
                $column->getName(),
                $this->typeRegistry->resolveType($column->getType()->getName())
            ));

            if (!in_array($column->getName(), $primaryColumnNames)) {
                $columnNames[] = $column->getName();
            }
        }

        $fillableProperty = new PropertyModel('fillable');
        $fillableProperty->setAccess('protected')
            ->setValue($columnNames)
            ->setDocBlock(new DocBlockModel('@var array'));
        $model->addProperty($fillableProperty);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPriority()
    {
        return 5;
    }
}
