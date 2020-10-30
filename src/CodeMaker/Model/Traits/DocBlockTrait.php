<?php

namespace dr360\CodeMaker\Model\Traits;

use dr360\CodeMaker\Model\DocBlockModel;

/**
 * Trait DocBlockTrait
 * @package dr360\CodeMaker\Model\Traits
 */
trait DocBlockTrait
{
    /**
     * @var DocBlockModel
     */
    protected $docBlock;

    /**
     * @return DocBlockModel
     */
    public function getDocBlock()
    {
        return $this->docBlock;
    }

    /**
     * @param DocBlockModel $docBlock
     *
     * @return $this
     */
    public function setDocBlock($docBlock)
    {
        $this->docBlock = $docBlock;

        return $this;
    }
}
