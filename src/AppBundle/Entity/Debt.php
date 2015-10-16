<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Debt
 *
 * @ORM\Table(name="debt")
 * @ORM\Entity
 */
class Debt
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="debts")
     * @ORM\JoinColumns({@ORM\JoinColumn(name="user_id", referencedColumnName="id")})
     */
    protected $user;

    /**
     * @var Bill
     *
     * @ORM\ManyToOne(targetEntity="Bill", inversedBy="debts")
     * @ORM\JoinColumns({@ORM\JoinColumn(name="bill_id", referencedColumnName="id")})
     */
    protected $bill;

    /**
     * @var string
     *
     * @ORM\Column(name="is_paid", type="boolean", nullable=true)
     */
    protected $isPaid;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255, nullable=true)
     */
    protected $comment;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer")
     */
    protected $total;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getBill()
    {
        return $this->bill;
    }

    /**
     * @param User $bill
     */
    public function setBill($bill)
    {
        $this->bill = $bill;
    }

    /**
     * @return string
     */
    public function getIsPaid()
    {
        return $this->isPaid;
    }

    /**
     * @param string $isPaid
     */
    public function setIsPaid($isPaid)
    {
        $this->isPaid = $isPaid;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }
}

