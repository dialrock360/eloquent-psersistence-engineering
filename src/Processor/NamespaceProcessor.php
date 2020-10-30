<?php

namespace dr360\EloquentEngineering\Processor;

// use dr360\CodeMaker\Model\NamespaceModel;
use dr360\CodeMaker\Model\NamespaceModel;
use dr360\EloquentEngineering\Config;
use dr360\EloquentEngineering\Model\EloquentModel;

/**
 * Class NamespaceProcessor
 * @package dr360\EloquentEngineering\Processor
 */
class NamespaceProcessor implements ProcessorInterface
{
    /**
     * @inheritdoc
     */
    public function process(EloquentModel $model, Config $config)
    {
        $model->setNamespace(new NamespaceModel($config->get('namespace')));
    }

    /**
     * @inheritdoc
     */
    public function getPriority()
    {
        return 6;
    }
}
