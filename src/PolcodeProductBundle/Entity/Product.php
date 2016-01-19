<?php
namespace PolcodeProductBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 * @Gedmo\TranslationEntity(class="PolcodeProductBundle\Entity\ProductTranslation")
 */
class Product {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @Gedmo\Translatable
     * @ORM\Column(type="text")
     */
    protected $name;
    
    /**
     * @Gedmo\Translatable
     * @ORM\Column(type="string")
     */
    protected $description;
    
    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $price;

	/**
	 * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category", referencedColumnName="id", onDelete="CASCADE")
     * 
	 */
	protected $category;
	
	/**
	 * @var \DateTime $created
	 *
	 * @Gedmo\Timestampable(on="create")
	 * @ORM\Column(type="datetime")
	 */
	private $created;
	
	/**
	 * @var \DateTime $updated
	 *
	 * @Gedmo\Timestampable(on="update")
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	private $updated;
	
	/**
	 * @var \DateTime $contentChanged
	 *
	 * @Gedmo\Timestampable(on="change", field={"title", "body"})
	 * @ORM\Column(name="content_changed", type="datetime", nullable=true)
	 */
	private $contentChanged;
	
	/**
	 * @Gedmo\Slug(fields={"name", "created"}, style="camel", separator="_", updatable=false, unique=false, dateFormat="d/m/Y H-i-s")
	 * @ORM\Column(length=128, unique=true)
	 */
	private $slug;

    /**
     * @ORM\OneToMany(targetEntity="ProductTranslation", mappedBy="object", cascade={"persist", "remove"})
     */
    protected $translations;

    /**
     * @Gedmo\Locale
     */
    private $locale;
	
	public function __construct() {
	    $this->created = new \DateTime();
	    $this->slug = uniqid();
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($value) {
		$this->id = $value;
		
		return $this;
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

	public function getPrice() {
		return $this->price;
	}
	
	public function setPrice($value) {
		$this->price = $value;
		
		return $this;
	}

	public function getCategory() {
	    return $this->category;
	}
	
	public function setCategory($value) {
	    $this->category = $value;
	
	    return $this;
	}
	
	public function getCreated() {
	    return $this->created;
	}
	
	public function setCreated($value) {
	    $this->created = $value;
	
	    return $this;
	}
	
	public function getUpdated() {
	    return $this->updated;
	}
	
	public function setUpdated($value) {
	    $this->updated = $value;
	
	    return $this;
	}
	
	public function getContentChanged() {
	    return $this->contentChanged;
	}
	
	public function setContentChanged($value) {
	    $this->contentChanged = $value;
	
	    return $this;
	}
	
	public function getSlug() {
	    return $this->slug;
	}
	
	public function setSlug($value) {
	    $this->slug = $value;
	
	    return $this;
	}

	public function addTranslation(\PolcodeProductBundle\Entity\ProductTranslation $translations)
	{
		$this->translations->add($translations);
		$translations->setObject($this);
	}

	public function removeTranslation(\PolcodeProductBundle\Entity\ProductTranslation $translations)
	{
		$this->translations->removeElement($translations);
	}
	
	public function getTranslations()
	{
		return $this->translations;
	}
	
	public function setLocale($locale)
	{
		$this->locale = $locale;
	}
	
}
