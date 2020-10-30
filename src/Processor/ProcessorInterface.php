<?php

namespace dr360\EloquentEngineering\Processor;

use dr360\EloquentEngineering\Config;
use dr360\EloquentEngineering\Model\EloquentModel;

/**
 * Interface ProcessorInterface
 * @package dr360\EloquentEngineering\Processor
 */
interface ProcessorInterface
{
    /**
     * @param EloquentModel $model
     * @param Config $config
     */
    public function process(EloquentModel $model, Config $config);

    /**
     * @return int
     */
    public function getPriority();
}
