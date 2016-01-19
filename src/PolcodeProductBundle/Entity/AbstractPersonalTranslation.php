<?php

namespace PolcodeProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation
 *
 * @ORM\MappedSuperclass
 */
abstract class AbstractPersonalTranslation
{
    /**
     * @var integer $id
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string $locale
     *
     * @ORM\Column(type="string", length=8)
     */
    protected $locale;

    /**
     * Related entity with ManyToOne relation
     * must be mapped by user
     */
    protected $object;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return static
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }
    
    /**
     * Set object related
     *
     * @param string $object
     *
     * @return static
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get related object
     *
     * @return object
     */
    public function getObject()
    {
        return $this->object;
    }

}
