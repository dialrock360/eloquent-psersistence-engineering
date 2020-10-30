<?php

namespace dr360\CodeMaker;

/**
 * Interface RenderableInterface
 * @package dr360\CodeMaker
 */
interface RenderableInterface
{
    /**
     * @param int $indent
     * @param string $delimiter
     * @return string
     */
    public function render($indent = 0, $delimiter = PHP_EOL);
}
