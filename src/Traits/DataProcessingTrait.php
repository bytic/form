<?php

namespace Nip\Form\Traits;

/**
 * Trait DataProcessingTrait
 * @package Nip\Form\Traits
 */
trait DataProcessingTrait
{

    /**
     * @param $request
     */
    protected function getDataFromRequest($request)
    {
        $elements = $this->getElements();
        if (is_array($elements)) {
            foreach ($elements as $name => $element) {
                if ($element->isGroup() && $element->isRequestArray()) {
                    $name = str_replace('[]', '', $name);
                    $data = is_array($request[$name]) ? $request[$name] : [$request[$name]];
                    $element->getData($data, 'request');
                } else {
                    $value = isset($request[$name]) ? $request[$name] : null;
                    if (strpos($name, '[') && strpos($name, ']')) {
                        $arrayPrimary = substr($name, 0, strpos($name, '['));
                        $arrayKeys = str_replace($arrayPrimary, '', $name);

                        preg_match_all('/\[([^\]]*)\]/', $arrayKeys, $arr_matches, PREG_PATTERN_ORDER);
                        $value = $request[$arrayPrimary];
                        foreach ($arr_matches[1] as $dimension) {
                            $value = $value[$dimension];
                        }
                    }
                    $element->getData($value, 'request');
                }
            }
        }
    }

    /**
     * @return array
     */
    public function getData()
    {
        $data = [];
        $elements = $this->getElements();
        if (is_array($elements)) {
            foreach ($elements as $element) {
                $name = $element->getName();
                if ($element->isGroup() && $element->isRequestArray()) {
                    $name = str_replace('[]', '', $name);
                    $data[$name][] = $element->getValue();
                    continue;
                }

                if (strpos($name, '[]')) {
                    $arrayPrimary = substr($name, 0, strpos($name, '['));
                    $data[$arrayPrimary][] = $element->getValue();
                    continue;
                }

                if (strpos($name, '[') && strpos($name, ']')) {
                    $arrayPrimary = substr($name, 0, strpos($name, '['));
                    $arrayKeys = str_replace($arrayPrimary, '', $name);

                    preg_match_all('/\[([^\]]*)\]/', $arrayKeys, $arr_matches, PREG_PATTERN_ORDER);

                    $dataArray = $element->getValue();
                    foreach ($arr_matches[1] as $dimension) {
                        $dataArray = [$dimension => $dataArray];
                    }

                    $data[$arrayPrimary] = (isset($data[$arrayPrimary]))
                        ? array_merge($data[$arrayPrimary], $dataArray)
                        : $dataArray;
                    continue;
                }
                $data[$name] = $element->getValue();
            }
        }

        return $data;
    }
}
