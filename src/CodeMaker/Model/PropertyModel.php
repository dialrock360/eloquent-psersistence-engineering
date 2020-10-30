<?php

namespace dr360\CodeMaker\Model;

use dr360\CodeMaker\Model\Traits\AccessModifierTrait;
use dr360\CodeMaker\Model\Traits\DocBlockTrait;
use dr360\CodeMaker\Model\Traits\StaticModifierTrait;
use dr360\CodeMaker\Model\Traits\ValueTrait;

/**

 * Class PHPClassProperty
 * @package dr360\CodeMaker\Model
 */
class PropertyModel extends BasePropertyModel
{
    use AccessModifierTrait;
    use DocBlockTrait;
    use StaticModifierTrait;
    use ValueTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * PropertyModel constructor.
     * @param string $name
     * @param string $access
     * @param mixed|null $value
     */
    public function __construct($name, $access = 'public', $value = null)
    {
        $this->setName($name)
            ->setAccess($access)
            ->setValue($value);
    }

    /**
     * {@inheritDoc}
     */
    public function toLines()
    {
        $lines = [];
        if ($this->docBlock !== null) {
            $lines = array_merge($lines, $this->docBlock->toLines());
        }

        $property = $this->access . ' ';
        if ($this->static) {
            $property .= 'static ';
        }
        $property .= '$' . $this->name;

        if ($this->value !== null) {
            $value = $this->renderValue();
            if ($value !== null) {
                $property .= sprintf(' = %s', $this->renderValue());
            }
        }
        $property .= ';';
        $lines[] = $property;

        return $lines;
    }
}
