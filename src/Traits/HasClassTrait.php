<?php

namespace Nip\Form\Traits;

/**
 * Trait HasClassTrait
 * @package Nip\Form\Traits
 */
trait HasClassTrait
{
    /**
     * @return $this
     */
    public function addClass()
    {
        $classes = func_get_args();
        $classes = array_map('trim', $classes);
        if (is_array($classes)) {
            $classes = implode(' ', $classes) . ' ' . $this->getAttrib('class');
            $newClasses = explode(' ', $classes);
            $newClasses = array_filter($newClasses);
            $newClasses = array_unique($newClasses);
            $this->setAttrib('class', trim(implode(' ', $newClasses)));
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function removeClass()
    {
        $removeClasses = func_get_args();
        $removeClasses = array_map('trim', $removeClasses);
        if (is_array($removeClasses)) {
            $classes = explode(' ', $this->getAttrib('class'));
            foreach ($removeClasses as $class) {
                $key = array_search($class, $classes);
                if ($key !== false) {
                    unset($classes[$key]);
                }
            }
            $this->setAttrib('class', implode(' ', $classes));
        }

        return $this;
    }

    /**
     * @param string $class
     * @return bool
     */
    public function hasClass($class)
    {
        return in_array($class, explode(' ', $this->getAttrib('class')));
    }
}
