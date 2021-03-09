<?php

class Nip_Form_Renderer_Elements_MultiSelect extends Nip_Form_Renderer_Elements_Select
{
    public function renderAttributes($overrides = []): string
    {
        return parent::renderAttributes($overrides) . ' multiple';
    }

    protected function isOptionSelected($value, $selectedValue): bool
    {
        if (!is_array($selectedValue)) {
            return false;
        }
        if (!in_array($value, $selectedValue)) {
            return false;
        }
        return true;
    }
}
