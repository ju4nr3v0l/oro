<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estado
 *
 * @ORM\Table(name="estado")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EstadoRepository")
 */
class Estado
{


    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="codigo_estado_llamada_pk", type="integer")
     */
    private $codigoEstadoLlamadaPk;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     *
     * @ORM\OneToMany(targetEntity="Llamada", mappedBy="llamadasEstadoRel")
     */


    private $estadoRel;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->estadoRel = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set codigoEstadoLlamadaPk
     *
     * @param integer $codigoEstadoLlamadaPk
     *
     * @return Estado
     */
    public function setCodigoEstadoLlamadaPk($codigoEstadoLlamadaPk)
    {
        $this->codigoEstadoLlamadaPk = $codigoEstadoLlamadaPk;

        return $this;
    }

    /**
     * Get codigoEstadoLlamadaPk
     *
     * @return integer
     */
    public function getCodigoEstadoLlamadaPk()
    {
        return $this->codigoEstadoLlamadaPk;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Estado
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Estado
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Add estadoRel
     *
     * @param \AppBundle\Entity\Llamada $estadoRel
     *
     * @return Estado
     */
    public function addEstadoRel(\AppBundle\Entity\Llamada $estadoRel)
    {
        $this->estadoRel[] = $estadoRel;

        return $this;
    }

    /**
     * Remove estadoRel
     *
     * @param \AppBundle\Entity\Llamada $estadoRel
     */
    public function removeEstadoRel(\AppBundle\Entity\Llamada $estadoRel)
    {
        $this->estadoRel->removeElement($estadoRel);
    }

    /**
     * Get estadoRel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEstadoRel()
    {
        return $this->estadoRel;
    }
}
