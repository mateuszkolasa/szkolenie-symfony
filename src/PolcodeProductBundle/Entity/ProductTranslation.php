<?php
namespace PolcodeProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PolcodeProductBundle\Entity\AbstractPersonalTranslation;
 
/**
 * @ORM\Entity
 * @ORM\Table(name="product_translations",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="lookup_unique_idx", columns={
 *         "locale", "object_id"
 *     })}
 * )
 */
class ProductTranslation
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
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="translations")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $object;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $description;
    
    /**
     * Convinient constructor
     *
     * @param string $locale
     */
    public function __construct($locale = null, $field = null, $content = null)
    {
        $this->setLocale($locale);
    }

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
    
    public function getName() {
		return $this->name;
	}
	
	public function setName($value) {
		$this->name = $value;
		
		return $this;
	}

	public function getDescription() {
		return $this->description;
	}
	
	public function setDescription($value) {
		$this->description = $value;
		
		return $this;
	}

    
    
    
}