<?php

namespace App\Bundle\Twig;

use Twig_Environment;
use Twig_Extension;
use Twig_SimpleFunction;

class AppCoreExtension extends Twig_Extension
{
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('httpPostButton', [$this, 'httpPostButton'], [
                'needs_environment' => true,
                'is_safe' => ['html'],
            ]),
        ];
    }

    public function httpPostButton(Twig_Environment $env, $label, $href, $class = null, $options = null)
    {
        $class = $class ?: '';
        $options = array_merge([
            'safe_label' => false,
        ], $options ?: []);

        $href = twig_escape_filter($env, $href);
        if (!$options['safe_label']) {
            $label = twig_escape_filter($env, $label);
        }
        $class = twig_escape_filter($env, $class);

        // Yeah, inline style is ugly, but this is a skeleton. Feel free to add Node.js/PHP compilation of LESS/SASS files :-)
        return <<<END
<form action="$href" method="POST" style="display: inline-block">
    <button class="$class" title=>$label</button>
</form>
END;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'app_core';
    }
}
