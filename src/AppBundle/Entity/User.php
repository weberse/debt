<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Event;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Event[]
     *
     * @ORM\ManyToMany(targetEntity="Event")
     * @ORM\JoinTable(
     *  joinColumns={
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     *  }
     * )
     */
    protected $events;

    /**
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(name="friends",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="friend_id", referencedColumnName="id")}
     * )
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $friends;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Bill", mappedBy="user")
     */
    protected $bills;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Debt", mappedBy="bills")
     */
    protected $debts;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return Event[]
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param Event[] $events
     */
    public function setEvents($events)
    {
        $this->events = $events;
    }

    /**
     * @return array
     */
    public function getFriends()
    {
        return $this->friends->toArray();
    }

    /**
     * @param  User $user
     * @return void
     */
    public function addFriend(User $user)
    {
        if (!$this->friends->contains($user)) {
            $this->friends->add($user);
            $user->addFriend($this);
        }
    }
}