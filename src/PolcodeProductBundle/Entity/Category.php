<?php
namespace PolcodeProductBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $name;
	
	/**
	 * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
	 *
	 */
	protected $products;
    
    public function __GET($name) {
        return $this->$name;
    }
    
    public function __set($name, $value) {
        $this->$name = $value;
        
        return $this;
    }
}
