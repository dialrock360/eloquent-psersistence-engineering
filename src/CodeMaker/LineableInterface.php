<?php

namespace dr360\CodeMaker;

/**
 * Interface LineableInterface
 * @package dr360\CodeMaker
 */
interface LineableInterface
{
    /**
     * @return string|string[]
     */
    public function toLines();
}
