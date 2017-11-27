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
     * @ORM\ManytoOne(targetEntity="Cliente", inversedBy="LlamadasRel")
     * @ORM\JoinColumn(name="codigoClienteFk", referencedColumnName="codigoClientePk")
     */
    private $llamadasCliente;

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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->llamadasCliente = new \Doctrine\Common\Collections\ArrayCollection();
        $this->llamadasCategoria = new \Doctrine\Common\Collections\ArrayCollection();
        $this->llamadasEstado = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add llamadasCliente
     *
     * @param \AppBundle\Entity\Cliente $llamadasCliente
     *
     * @return Llamada
     */
    public function addLlamadasCliente(\AppBundle\Entity\Cliente $llamadasCliente)
    {
        $this->llamadasCliente[] = $llamadasCliente;

        return $this;
    }

    /**
     * Remove llamadasCliente
     *
     * @param \AppBundle\Entity\Cliente $llamadasCliente
     */
    public function removeLlamadasCliente(\AppBundle\Entity\Cliente $llamadasCliente)
    {
        $this->llamadasCliente->removeElement($llamadasCliente);
    }

    /**
     * Get llamadasCliente
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLlamadasCliente()
    {
        return $this->llamadasCliente;
    }

    /**
     * Add llamadasCategorium
     *
     * @param \AppBundle\Entity\LlamadaCategoria $llamadasCategorium
     *
     * @return Llamada
     */
    public function addLlamadasCategorium(\AppBundle\Entity\LlamadaCategoria $llamadasCategorium)
    {
        $this->llamadasCategoria[] = $llamadasCategorium;

        return $this;
    }

    /**
     * Remove llamadasCategorium
     *
     * @param \AppBundle\Entity\LlamadaCategoria $llamadasCategorium
     */
    public function removeLlamadasCategorium(\AppBundle\Entity\LlamadaCategoria $llamadasCategorium)
    {
        $this->llamadasCategoria->removeElement($llamadasCategorium);
    }

    /**
     * Get llamadasCategoria
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLlamadasCategoria()
    {
        return $this->llamadasCategoria;
    }

    /**
     * Add llamadasEstado
     *
     * @param \AppBundle\Entity\Estado $llamadasEstado
     *
     * @return Llamada
     */
    public function addLlamadasEstado(\AppBundle\Entity\Estado $llamadasEstado)
    {
        $this->llamadasEstado[] = $llamadasEstado;

        return $this;
    }

    /**
     * Remove llamadasEstado
     *
     * @param \AppBundle\Entity\Estado $llamadasEstado
     */
    public function removeLlamadasEstado(\AppBundle\Entity\Estado $llamadasEstado)
    {
        $this->llamadasEstado->removeElement($llamadasEstado);
    }

    /**
     * Get llamadasEstado
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLlamadasEstado()
    {
        return $this->llamadasEstado;
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
     * Set llamadasCliente
     *
     * @param \AppBundle\Entity\Cliente $llamadasCliente
     *
     * @return Llamada
     */
    public function setLlamadasCliente(\AppBundle\Entity\Cliente $llamadasCliente = null)
    {
        $this->llamadasCliente = $llamadasCliente;

        return $this;
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
}
