<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Bill
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\BillRepository")
 */
class Bill
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="bills")
     * @ORM\JoinColumns({@ORM\JoinColumn(name="user_id", referencedColumnName="id")})
     */
    protected $user;

    /**
     * @var Event
     *
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="bills")
     * @ORM\JoinColumns({@ORM\JoinColumn(name="event_id", referencedColumnName="id")})
     */
    protected $event;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Debt", mappedBy="bills")
     */
    protected $debts;

    /**
     * @var integer
     *
     * @ORM\Column(name="total", type="integer")
     */
    private $total;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255)
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="date")
     */
    private $createdAt;

    public function __construct() {
        $this->getCreatedAt(new \DateTime());
    }
}

