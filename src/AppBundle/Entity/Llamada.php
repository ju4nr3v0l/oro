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
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="codigoLlamadaPk", type="integer", unique=true, )
     */
    private $codigoLlamadaPk;

    /**
     * @var string
     *
     * @ORM\Column(name="tema", type="string", length=255, nullable= TRUE)
     */
    private $tema;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreContacto", type="string" ,length=255, nullable= TRUE)
     */
    private $nombreContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255 ,nullable= TRUE)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=255, nullable= TRUE)
     */
    private $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255 ,nullable= TRUE)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRegistro", type="datetime", nullable= TRUE)
     */
    private $fechaRegistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaGestion", type="datetime" ,nullable= TRUE)
     */
    private $fechaGestion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaSolucion", type="datetime" ,nullable= TRUE)
     */
    private $fechaSolucion;

    /**
     * @var int
     *
     * @ORM\Column(name="codigoCategoriaLlamadaFk", type="integer" ,nullable= TRUE)
     */
    private $codigoCategoriaLlamadaFk;

    /**
     * @var int
     *
     * @ORM\Column(name="codigoUsuarioRecibeFk", type="string", length=255 ,nullable= TRUE)
     */
    private $codigoUsuarioRecibeFk;

    /**
     * @var int
     *
     * @ORM\Column(name="codigoUsuarioAtiendeFk", type="string", length=255, nullable= TRUE)
     */
    private $codigoUsuarioAtiendeFk;

    /**
     * @var int
     *
     * @ORM\Column(name="codigoEstadoLlamadaFk", type="integer" ,nullable= TRUE)
     */
    private $codigoEstadoLlamadaFk;

    /**
     * @var int
     *
     * @ORM\Column(name="codigoClienteFk", type="integer" ,nullable= TRUE)
     */
    private $codigoClienteFk;


    /**
     * @ORM\ManytoOne(targetEntity="Cliente", inversedBy="llamadasClienteRel")
     * @ORM\JoinColumn(name="codigoClienteFk", referencedColumnName="codigoClientePk")
     */
    private $clienteRel;

    /**
     * @ORM\ManytoOne(targetEntity="LlamadaCategoria", inversedBy="llamadasCategoriaRel")
     * @ORM\JoinColumn(name="codigoCategoriaLlamadaFk", referencedColumnName="codigoCategoriaLlamadaPk")
     */
    private $llamadasCategoria;


    /**
     * @ORM\ManytoOne(targetEntity="Estado", inversedBy="estadoRel")
     * @ORM\JoinColumn(name="codigoEstadoLlamadaFk", referencedColumnName="codigoEstadoLlamadaPk")
     */
    private $llamadasEstado;


    /**
     * Get codigoLlamadaPk
     *
     * @return integer
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
     * Set nombreContacto
     *
     * @param string $nombreContacto
     *
     * @return Llamada
     */
    public function setNombreContacto($nombreContacto)
    {
        $this->nombreContacto = $nombreContacto;

        return $this;
    }

    /**
     * Get nombreContacto
     *
     * @return string
     */
    public function getNombreContacto()
    {
        return $this->nombreContacto;
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
     * @param \DateTime $fechaGestion
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
     * @return \DateTime
     */
    public function getFechaGestion()
    {
        return $this->fechaGestion;
    }

    /**
     * Set fechaSolucion
     *
     * @param \DateTime $fechaSolucion
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
     * @return \DateTime
     */
    public function getFechaSolucion()
    {
        return $this->fechaSolucion;
    }

    /**
     * Set codigoCategoriaLlamadaFk
     *
     * @param integer $codigoCategoriaLlamadaFk
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
     * @return integer
     */
    public function getCodigoCategoriaLlamadaFk()
    {
        return $this->codigoCategoriaLlamadaFk;
    }

    /**
     * Set codigoUsuarioRecibeFk
     *
     * @param string $codigoUsuarioRecibeFk
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
     * @return string
     */
    public function getCodigoUsuarioRecibeFk()
    {
        return $this->codigoUsuarioRecibeFk;
    }

    /**
     * Set codigoUsuarioAtiendeFk
     *
     * @param string $codigoUsuarioAtiendeFk
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
     * @return string
     */
    public function getCodigoUsuarioAtiendeFk()
    {
        return $this->codigoUsuarioAtiendeFk;
    }

    /**
     * Set codigoEstadoLlamadaFk
     *
     * @param integer $codigoEstadoLlamadaFk
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
     * @return integer
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
     * @return integer
     */
    public function getCodigoClienteFk()
    {
        return $this->codigoClienteFk;
    }

    /**
     * Set clienteRel
     *
     * @param \AppBundle\Entity\Cliente $clienteRel
     *
     * @return Llamada
     */
    public function setClienteRel(\AppBundle\Entity\Cliente $clienteRel = null)
    {
        $this->clienteRel = $clienteRel;

        return $this;
    }

    /**
     * Get clienteRel
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getClienteRel()
    {
        return $this->clienteRel;
    }

    /**
     * Set llamadasCategoria
     *
     * @param \AppBundle\Entity\LlamadaCategoria $llamadasCategoria
     *
     * @return Llamada
     */
    public function setLlamadasCategoria(\AppBundle\Entity\LlamadaCategoria $llamadasCategoria = null)
    {
        $this->llamadasCategoria = $llamadasCategoria;

        return $this;
    }

    /**
     * Get llamadasCategoria
     *
     * @return \AppBundle\Entity\LlamadaCategoria
     */
    public function getLlamadasCategoria()
    {
        return $this->llamadasCategoria;
    }

    /**
     * Set llamadasEstado
     *
     * @param \AppBundle\Entity\Estado $llamadasEstado
     *
     * @return Llamada
     */
    public function setLlamadasEstado(\AppBundle\Entity\Estado $llamadasEstado = null)
    {
        $this->llamadasEstado = $llamadasEstado;

        return $this;
    }

    /**
     * Get llamadasEstado
     *
     * @return \AppBundle\Entity\Estado
     */
    public function getLlamadasEstado()
    {
        return $this->llamadasEstado;
    }
}
