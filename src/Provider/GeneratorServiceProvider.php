<?php

namespace dr360\EloquentEngineering\Provider;

use Illuminate\Support\ServiceProvider;
use dr360\EloquentEngineering\Command\ModelGeneratorCommand;
use dr360\EloquentEngineering\EloquentEngineering;
use dr360\EloquentEngineering\Processor\CustomPrimaryKeyProcessor;
use dr360\EloquentEngineering\Processor\CustomPropertyProcessor;
use dr360\EloquentEngineering\Processor\ExistenceCheckerProcessor;
use dr360\EloquentEngineering\Processor\FieldProcessor;
use dr360\EloquentEngineering\Processor\NamespaceProcessor;
use dr360\EloquentEngineering\Processor\RelationProcessor;
use dr360\EloquentEngineering\Processor\TableNameProcessor;

/**
 * Class GeneratorServiceProvider
 * @package dr360\EloquentEngineering\Provider
 */
class GeneratorServiceProvider extends ServiceProvider
{
    const PROCESSOR_TAG = 'eloquent_model_generator.processor';

    /**
     * {@inheritDoc}
     */
    public function register()
    {
        $this->commands([
            ModelGeneratorCommand::class,
        ]);

        $this->app->tag([
            ExistenceCheckerProcessor::class,
            FieldProcessor::class,
            NamespaceProcessor::class,
            RelationProcessor::class,
            CustomPropertyProcessor::class,
            TableNameProcessor::class,
            CustomPrimaryKeyProcessor::class,
        ], self::PROCESSOR_TAG);

        $this->app->bind(EloquentEngineering::class, function ($app) {
            return new EloquentEngineering($app->tagged(self::PROCESSOR_TAG));
        });
    }
}
