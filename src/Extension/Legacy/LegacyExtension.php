<?php

namespace Nip\Form\Extension\Legacy;

use Nip_Form_Button_Button;
use Nip_Form_Element_Checkbox;
use Nip_Form_Element_CheckboxGroup;
use Nip_Form_Element_Dateinput;
use Nip_Form_Element_Dateselect;
use Nip_Form_Element_File;
use Nip_Form_Element_Hidden;
use Nip_Form_Element_MultiSelect;
use Nip_Form_Element_Password;
use Nip_Form_Element_Radio;
use Nip_Form_Element_RadioGroup;
use Nip_Form_Element_Select;
use Nip_Form_Element_Textarea;
use Nip_Form_Element_Texteditor;
use Nip_Form_Element_TextMiniEditor;
use Nip_Form_Element_TextSimpleEditor;
use Nip_Form_Element_Timeselect;
use Symfony\Component\Form\AbstractExtension;

/**
 * Class LegacyExtension
 * @package Nip\Form\Extension\Legacy
 */
class LegacyExtension extends AbstractExtension
{
    protected $aliases = [
        'button'           => Nip_Form_Button_Button::class,
        'Button'           => Nip_Form_Button_Button::class,
        'checkbox'         => Nip_Form_Element_Checkbox::class,
        'Checkbox'         => Nip_Form_Element_Checkbox::class,
        'checkboxGroup'    => Nip_Form_Element_CheckboxGroup::class,
        'CheckboxGroup'    => Nip_Form_Element_CheckboxGroup::class,
        'date'             => Nip_Form_Element_Dateinput::class,
        'Date'             => Nip_Form_Element_Dateinput::class,
        'dateinput'        => Nip_Form_Element_Dateinput::class,
        'Dateinput'        => Nip_Form_Element_Dateinput::class,
        'dateselect'       => Nip_Form_Element_Dateselect::class,
        'dateSelect'       => Nip_Form_Element_Dateselect::class,
        'DateSelect'       => Nip_Form_Element_Dateselect::class,
        'file'             => Nip_Form_Element_File::class,
        'File'             => Nip_Form_Element_File::class,
        'hidden'           => Nip_Form_Element_Hidden::class,
        'Hidden'           => Nip_Form_Element_Hidden::class,
        'multiselect'      => Nip_Form_Element_MultiSelect::class,
        'multiSelect'      => Nip_Form_Element_MultiSelect::class,
        'MultiSelect'      => Nip_Form_Element_MultiSelect::class,
        'password'         => Nip_Form_Element_Password::class,
        'Password'         => Nip_Form_Element_Password::class,
        'radio'            => Nip_Form_Element_Radio::class,
        'Radio'            => Nip_Form_Element_Radio::class,
        'radioGroup'       => Nip_Form_Element_RadioGroup::class,
        'RadioGroup'       => Nip_Form_Element_RadioGroup::class,
        'select'           => Nip_Form_Element_Select::class,
        'Select'           => Nip_Form_Element_Select::class,
        'textarea'         => Nip_Form_Element_Textarea::class,
        'Textarea'         => Nip_Form_Element_Textarea::class,
        'texteditor'       => Nip_Form_Element_Texteditor::class,
        'Texteditor'       => Nip_Form_Element_Texteditor::class,
        'TextEditor'       => Nip_Form_Element_Texteditor::class,
        'textminieditor'   => Nip_Form_Element_TextMiniEditor::class,
        'textMiniEditor'   => Nip_Form_Element_TextMiniEditor::class,
        'TextMiniEditor'   => Nip_Form_Element_TextMiniEditor::class,
        'textsimpleeditor' => Nip_Form_Element_TextSimpleEditor::class,
        'textSimpleEditor' => Nip_Form_Element_TextSimpleEditor::class,
        'TextSimpleEditor' => Nip_Form_Element_TextSimpleEditor::class,
        'timeselect'       => Nip_Form_Element_Timeselect::class,
        'TimeSelect'       => Nip_Form_Element_Timeselect::class,
    ];
}