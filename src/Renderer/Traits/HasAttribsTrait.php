<?php

namespace Nip\Form\Renderer\Traits;

use Nip\Utility\Str;

/**
 * Trait HasAttribsTrait
 * @package Nip\Form\Renderer\Traits
 */
trait HasAttribsTrait
{
    /**
     * @param array $overrides
     * @return string
     */
    public function renderAttributes($overrides = [])
    {
        $attribs = $this->getElement()->getAttribs();
        if (!isset($attribs['title'])) {
            $attribs['title'] = $this->getElement()->getLabel();
        }
        $allowedAttribs = $this->getAllowedAttributes();
        $attribs = array_filter(
            $attribs,
            function ($key) use ($allowedAttribs) {
                return $this->canRenderAttribute($key, $allowedAttribs);
            },
            ARRAY_FILTER_USE_KEY
        );
        $return = '';
        foreach ($attribs as $name => $value) {
            if (in_array($name, array_keys($overrides))) {
                $value = $overrides[$name];
            }

            $return .= ' ' . $name . '="' . $value . '"';
        }

        return $return;
    }

    /**
     * @return array
     */
    public function getAllowedAttributes()
    {
        return ['id', 'name', 'style', 'class', 'title', 'read_only', 'disabled'];
    }

    /**
     * @param $name
     * @param null $allowed
     * @return bool
     */
    protected function canRenderAttribute($name, $allowed = null)
    {
        $allowed = $allowed ?: $this->getAllowedAttributes();
        if (in_array($name, $allowed)) {
            return true;
        }
        if (Str::startsWith($name, 'data-')) {
            return true;
        }
        return false;
    }
}
