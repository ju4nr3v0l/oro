<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LlamadaCategoria
 *
 * @ORM\Table(name="llamada_categoria")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LlamadaCategoriaRepository")
 */
class LlamadaCategoria
{


    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="codigoCategoriaLlamadaPk", type="integer", unique=true)
     */
    private $codigoCategoriaLlamadaPk;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
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
     * @ORM\OneToMany(targetEntity="Llamada", mappedBy="llamadasCategoria")
     */

    private $llamadasCategoriaRel;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set codigoCategoriaLlamadaPk
     *
     * @param integer $codigoCategoriaLlamadaPk
     *
     * @return LlamadaCategoria
     */
    public function setCodigoCategoriaLlamadaPk($codigoCategoriaLlamadaPk)
    {
        $this->codigoCategoriaLlamadaPk = $codigoCategoriaLlamadaPk;

        return $this;
    }

    /**
     * Get codigoCategoriaLlamadaPk
     *
     * @return int
     */
    public function getCodigoCategoriaLlamadaPk()
    {
        return $this->codigoCategoriaLlamadaPk;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return LlamadaCategoria
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
     * @return LlamadaCategoria
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
     * Set llamadasCategoriaRel
     *
     * @param \AppBundle\Entity\Llamada $llamadasCategoriaRel
     *
     * @return LlamadaCategoria
     */
    public function setLlamadasCategoriaRel(\AppBundle\Entity\Llamada $llamadasCategoriaRel = null)
    {
        $this->llamadasCategoriaRel = $llamadasCategoriaRel;

        return $this;
    }

    /**
     * Get llamadasCategoriaRel
     *
     * @return \AppBundle\Entity\Llamada
     */
    public function getLlamadasCategoriaRel()
    {
        return $this->llamadasCategoriaRel;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->llamadasCategoriaRel = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add llamadasCategoriaRel
     *
     * @param \AppBundle\Entity\Llamada $llamadasCategoriaRel
     *
     * @return LlamadaCategoria
     */
    public function addLlamadasCategoriaRel(\AppBundle\Entity\Llamada $llamadasCategoriaRel)
    {
        $this->llamadasCategoriaRel[] = $llamadasCategoriaRel;

        return $this;
    }

    /**
     * Remove llamadasCategoriaRel
     *
     * @param \AppBundle\Entity\Llamada $llamadasCategoriaRel
     */
    public function removeLlamadasCategoriaRel(\AppBundle\Entity\Llamada $llamadasCategoriaRel)
    {
        $this->llamadasCategoriaRel->removeElement($llamadasCategoriaRel);
    }
}
