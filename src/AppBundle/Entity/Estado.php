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
     * @ORM\OneToMany(targetEntity="Llamada", mappedBy="estadoRel")
     */


    private $llamadasEstadoRel;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->llamadasEstadoRel = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add llamadasEstadoRel
     *
     * @param \AppBundle\Entity\Llamada $llamadasEstadoRel
     *
     * @return Estado
     */
    public function addLlamadasEstadoRel(\AppBundle\Entity\Llamada $llamadasEstadoRel)
    {
        $this->llamadasEstadoRel[] = $llamadasEstadoRel;

        return $this;
    }

    /**
     * Remove llamadasEstadoRel
     *
     * @param \AppBundle\Entity\Llamada $llamadasEstadoRel
     */
    public function removeLlamadasEstadoRel(\AppBundle\Entity\Llamada $llamadasEstadoRel)
    {
        $this->llamadasEstadoRel->removeElement($llamadasEstadoRel);
    }

    /**
     * Get llamadasEstadoRel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLlamadasEstadoRel()
    {
        return $this->llamadasEstadoRel;
    }
}
