<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BankTransferRepository")
 */
class BankTransfer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Bank_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $IBAN;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $BIC;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $account_owner;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bankTransfers")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBankName(): ?string
    {
        return $this->Bank_name;
    }

    public function setBankName(string $Bank_name): self
    {
        $this->Bank_name = $Bank_name;

        return $this;
    }

    public function getIBAN(): ?string
    {
        return $this->IBAN;
    }

    public function setIBAN(string $IBAN): self
    {
        $this->IBAN = $IBAN;

        return $this;
    }

    public function getBIC(): ?string
    {
        return $this->BIC;
    }

    public function setBIC(string $BIC): self
    {
        $this->BIC = $BIC;

        return $this;
    }

    public function getAccountOwner(): ?string
    {
        return $this->account_owner;
    }

    public function setAccountOwner(string $account_owner): self
    {
        $this->account_owner = $account_owner;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
