<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Todo
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"unsigned": true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $done = false;

    /**
     * @param string $content
     */
    private function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @param string $content
     *
     * @return Todo
     */
    public static function create($content)
    {
        $newTodo = new self($content);

        return $newTodo;
    }

    public function markAsDone()
    {
        $this->done = true;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return bool
     */
    public function isDone()
    {
        return $this->done;
    }

    /**
     * @return bool
     */
    public function isPending()
    {
        return !$this->isDone();
    }
}
