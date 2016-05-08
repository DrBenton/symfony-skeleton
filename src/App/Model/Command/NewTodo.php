<?php

namespace App\Model\Command;

use Symfony\Component\Validator\Constraints as Assert;

class NewTodo
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="3")
     */
    public $content;
}
