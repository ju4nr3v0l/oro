<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Llamada
 *
 * @ORM\Table(name="llamada")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LlamadaRepository")
 */
class Llamada
{


    /**
     * @var int
     *
     * @ORM\Column(name="codigoLlamadaPk", type="integer", unique=true)
     */
    private $codigoLlamadaPk;

    /**
     * @var string
     *
     * @ORM\Column(name="tema", type="string", length=255)
     */
    private $tema;

    /**
     * @var int
     *
     * @ORM\Column(name="codigoContactoFk", type="integer")
     */
    private $codigoContactoFk;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=255)
     */
    private $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRegistro", type="datetime")
     */
    private $fechaRegistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaGestion", type="datetime")
     */
    private $fechaGestion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaSolucion", type="datetime")
     */
    private $fechaSolucion;

    /**
     * @var int
     *
     * @ORM\Column(name="codigoCategoriaLlamadaFk", type="integer")
     */
    private $codigoCategoriaLlamadaFk;

    /**
     * @var int
     *
     * @ORM\Column(name="codigoUsuarioRecibeFk", type="integer")
     */
    private $codigoUsuarioRecibeFk;

    /**
     * @var int
     *
     * @ORM\Column(name="codigoUsuarioAtiendeFk", type="integer")
     */
    private $codigoUsuarioAtiendeFk;

    /**
     * @var int
     *
     * @ORM\Column(name="codigoEstadoLlamadaFk", type="integer")
     */
    private $codigoEstadoLlamadaFk;

    /**
     * @var int
     *
     * @ORM\Column(name="codigoClienteFk", type="integer")
     */
    private $codigoClienteFk;


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
     * Set codigoLlamadaPk
     *
     * @param integer $codigoLlamadaPk
     *
     * @return Llamada
     */
    public function setCodigoLlamadaPk($codigoLlamadaPk)
    {
        $this->codigoLlamadaPk = $codigoLlamadaPk;

        return $this;
    }

    /**
     * Get codigoLlamadaPk
     *
     * @return int
     */
    public function getCodigoLlamadaPk()
    {
        return $this->codigoLlamadaPk;
    }

    /**
     * Set tema
     *
     * @param string $tema
     *
     * @return Llamada
     */
    public function setTema($tema)
    {
        $this->tema = $tema;

        return $this;
    }

    /**
     * Get tema
     *
     * @return string
     */
    public function getTema()
    {
        return $this->tema;
    }

    /**
     * Set codigoContactoFk
     *
     * @param integer $codigoContactoFk
     *
     * @return Llamada
     */
    public function setCodigoContactoFk($codigoContactoFk)
    {
        $this->codigoContactoFk = $codigoContactoFk;

        return $this;
    }

    /**
     * Get codigoContactoFk
     *
     * @return int
     */
    public function getCodigoContactoFk()
    {
        return $this->codigoContactoFk;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Llamada
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set extension
     *
     * @param string $extension
     *
     * @return Llamada
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Llamada
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
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return Llamada
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set fechaGestion
     *
     * @param string $fechaGestion
     *
     * @return Llamada
     */
    public function setFechaGestion($fechaGestion)
    {
        $this->fechaGestion = $fechaGestion;

        return $this;
    }

    /**
     * Get fechaGestion
     *
     * @return string
     */
    public function getFechaGestion()
    {
        return $this->fechaGestion;
    }

    /**
     * Set fechaSolucion
     *
     * @param string $fechaSolucion
     *
     * @return Llamada
     */
    public function setFechaSolucion($fechaSolucion)
    {
        $this->fechaSolucion = $fechaSolucion;

        return $this;
    }

    /**
     * Get fechaSolucion
     *
     * @return string
     */
    public function getFechaSolucion()
    {
        return $this->fechaSolucion;
    }

    /**
     * Set codigoCategoriaLlamadaFk
     *
     * @param string $codigoCategoriaLlamadaFk
     *
     * @return Llamada
     */
    public function setCodigoCategoriaLlamadaFk($codigoCategoriaLlamadaFk)
    {
        $this->codigoCategoriaLlamadaFk = $codigoCategoriaLlamadaFk;

        return $this;
    }

    /**
     * Get codigoCategoriaLlamadaFk
     *
     * @return string
     */
    public function getCodigoCategoriaLlamadaFk()
    {
        return $this->codigoCategoriaLlamadaFk;
    }

    /**
     * Set codigoUsuarioRecibeFk
     *
     * @param integer $codigoUsuarioRecibeFk
     *
     * @return Llamada
     */
    public function setCodigoUsuarioRecibeFk($codigoUsuarioRecibeFk)
    {
        $this->codigoUsuarioRecibeFk = $codigoUsuarioRecibeFk;

        return $this;
    }

    /**
     * Get codigoUsuarioRecibeFk
     *
     * @return int
     */
    public function getCodigoUsuarioRecibeFk()
    {
        return $this->codigoUsuarioRecibeFk;
    }

    /**
     * Set codigoUsuarioAtiendeFk
     *
     * @param integer $codigoUsuarioAtiendeFk
     *
     * @return Llamada
     */
    public function setCodigoUsuarioAtiendeFk($codigoUsuarioAtiendeFk)
    {
        $this->codigoUsuarioAtiendeFk = $codigoUsuarioAtiendeFk;

        return $this;
    }

    /**
     * Get codigoUsuarioAtiendeFk
     *
     * @return int
     */
    public function getCodigoUsuarioAtiendeFk()
    {
        return $this->codigoUsuarioAtiendeFk;
    }

    /**
     * Set codigoEstadoLlamadaFk
     *
     * @param string $codigoEstadoLlamadaFk
     *
     * @return Llamada
     */
    public function setCodigoEstadoLlamadaFk($codigoEstadoLlamadaFk)
    {
        $this->codigoEstadoLlamadaFk = $codigoEstadoLlamadaFk;

        return $this;
    }

    /**
     * Get codigoEstadoLlamadaFk
     *
     * @return string
     */
    public function getCodigoEstadoLlamadaFk()
    {
        return $this->codigoEstadoLlamadaFk;
    }

    /**
     * Set codigoClienteFk
     *
     * @param integer $codigoClienteFk
     *
     * @return Llamada
     */
    public function setCodigoClienteFk($codigoClienteFk)
    {
        $this->codigoClienteFk = $codigoClienteFk;

        return $this;
    }

    /**
     * Get codigoClienteFk
     *
     * @return int
     */
    public function getCodigoClienteFk()
    {
        return $this->codigoClienteFk;
    }
}
