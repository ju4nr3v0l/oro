<?php
/**
 * Created by PhpStorm.
 * User: avera
 * Date: 6/12/17
 * Time: 08:48 AM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caso
 *
 * @ORM\Table(name="prioridad")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PrioridadRepository")
 */
class Prioridad
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="codigo_prioridad_pk", type="string", length=50, unique=true)
     */
    private $codigo_prioridad_pk;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=50)
     */
    private $color;

    /**
     *
     * @ORM\OneToMany(targetEntity="Caso", mappedBy="prioridadRel")
     */
    private $casosPrioridadRel;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->casosPrioridadRel = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set codigoPrioridadPk
     *
     * @param string $codigoPrioridadPk
     *
     * @return Prioridad
     */
    public function setCodigoPrioridadPk($codigoPrioridadPk)
    {
        $this->codigo_prioridad_pk = $codigoPrioridadPk;

        return $this;
    }

    /**
     * Get codigoPrioridadPk
     *
     * @return string
     */
    public function getCodigoPrioridadPk()
    {
        return $this->codigo_prioridad_pk;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Prioridad
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Prioridad
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Add casosPrioridadRel
     *
     * @param \AppBundle\Entity\Caso $casosPrioridadRel
     *
     * @return Prioridad
     */
    public function addCasosPrioridadRel(\AppBundle\Entity\Caso $casosPrioridadRel)
    {
        $this->casosPrioridadRel[] = $casosPrioridadRel;

        return $this;
    }

    /**
     * Remove casosPrioridadRel
     *
     * @param \AppBundle\Entity\Caso $casosPrioridadRel
     */
    public function removeCasosPrioridadRel(\AppBundle\Entity\Caso $casosPrioridadRel)
    {
        $this->casosPrioridadRel->removeElement($casosPrioridadRel);
    }

    /**
     * Get casosPrioridadRel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCasosPrioridadRel()
    {
        return $this->casosPrioridadRel;
    }
}
