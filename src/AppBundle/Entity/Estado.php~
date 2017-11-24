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
     *
     * @ORM\Column(name="codigoEstadoLlamadaPk", type="integer")
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return int
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
}
