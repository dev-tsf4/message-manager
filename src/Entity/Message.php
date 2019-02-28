<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @Assert\Length(max="50")
     *
     * @ORM\Column(type="string", length=255)
     */
    private $subject;

    /**
     * @Assert\NotBlank
     * @Assert\Length(max="500")
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    protected $treated = false;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="messages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $from;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getFrom(): ?User
    {
        return $this->from;
    }

    public function setFrom(?User $user): self
    {
        $this->from = $user;

        return $this;
    }

    public function isTreated(): bool
    {
        return $this->treated;
    }

    public function setTreated(bool $treated)
    {
        $this->treated = $treated;
    }

    public function treat()
    {
        $this->treated = true;
    }
}


