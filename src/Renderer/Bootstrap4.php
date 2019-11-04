<?php

/**
 * Class Bootstrap4
 */
class Nip_Form_Renderer_Bootstrap4 extends Nip_Form_Renderer_Bootstrap
{

    /**
     * @inheritDoc
     */
    protected function getLabelClassesForElement($element)
    {
        $classes = parent::getLabelClassesForElement($element);
        $key = array_search('control-label', $classes);
        $classes[$key] = 'col-form-label';

        return $classes;
    }
}
