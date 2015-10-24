<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AutoSubscribe
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class AutoSubscribe
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
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="section_id", type="integer")
     */
    private $sectionId;

    /**
     * @var integer
     *
     * @ORM\Column(name="brand_id", type="integer")
     */
    private $brandId;

    /**
     * @var integer
     *
     * @ORM\Column(name="age_id", type="integer")
     */
    private $ageId;

    /**
     * @var integer
     *
     * @ORM\Column(name="size_id", type="integer")
     */
    private $sizeId;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return AutoSubscribe
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set sectionId
     *
     * @param integer $sectionId
     * @return AutoSubscribe
     */
    public function setSectionId($sectionId)
    {
        $this->sectionId = $sectionId;

        return $this;
    }

    /**
     * Get sectionId
     *
     * @return integer 
     */
    public function getSectionId()
    {
        return $this->sectionId;
    }

    /**
     * Set brandId
     *
     * @param integer $brandId
     * @return AutoSubscribe
     */
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;

        return $this;
    }

    /**
     * Get brandId
     *
     * @return integer 
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * Set ageId
     *
     * @param integer $ageId
     * @return AutoSubscribe
     */
    public function setAgeId($ageId)
    {
        $this->ageId = $ageId;

        return $this;
    }

    /**
     * Get ageId
     *
     * @return integer 
     */
    public function getAgeId()
    {
        return $this->ageId;
    }

    /**
     * Set sizeId
     *
     * @param integer $sizeId
     * @return AutoSubscribe
     */
    public function setSizeId($sizeId)
    {
        $this->sizeId = $sizeId;

        return $this;
    }

    /**
     * Get sizeId
     *
     * @return integer 
     */
    public function getSizeId()
    {
        return $this->sizeId;
    }
}
