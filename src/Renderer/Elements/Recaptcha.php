<?php

declare(strict_types=1);

use Nip\Form\Renderer\Elements\AbstractElementRenderer;

class Nip_Form_Renderer_Elements_Recaptcha extends AbstractElementRenderer
{
    public function generateElement()
    {
        $lang = null;

        $return = '<!-- Default behaviour looks for the g-recaptcha class with a data-sitekey attribute -->';
        $return .= '<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=' . $lang . '"></script>';
        $return .= '<div class="g-recaptcha form-field" data-sitekey="' . $this->getElement()->getSiteKey(
            ) . '"></div>';
        return $return;
    }
}
