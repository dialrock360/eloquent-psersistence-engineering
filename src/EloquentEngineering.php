<?php

namespace dr360\EloquentEngineering;

use dr360\EloquentEngineering\Exception\GeneratorException;
use dr360\EloquentEngineering\Model\EloquentModel;
use dr360\EloquentEngineering\Processor\ProcessorInterface;

/**
 * Class EloquentEngineering
 * @package dr360\EloquentEngineering
 */
class EloquentEngineering
{
    /**
     * @var ProcessorInterface[]
     */
    protected $processors;

    /**
     * EloquentEngineering constructor.
     * @param ProcessorInterface[]|\IteratorAggregate $processors
     */
    public function __construct($processors)
    {
        if ($processors instanceof \IteratorAggregate) {
            $this->processors = iterator_to_array($processors);
        } else {
            $this->processors = $processors;
        }
    }

    /**
     * @param Config $config
     * @return EloquentModel
     * @throws GeneratorException
     */
    public function createModel(Config $config)
    {
        $model = new EloquentModel();

        $this->prepareProcessors();

        foreach ($this->processors as $processor) {
            $processor->process($model, $config);
        }

        return $model;
    }

    /**
     * Sort processors by priority
     */
    protected function prepareProcessors()
    {
        usort($this->processors, function (ProcessorInterface $one, ProcessorInterface $two) {
            if ($one->getPriority() == $two->getPriority()) {
                return 0;
            }

            return $one->getPriority() < $two->getPriority() ? 1 : -1;
        });
    }
}
