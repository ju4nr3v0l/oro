<?php
/**
 * Created by Juan David Marulanda V.
 * User: @ju4nr3v0l
 * appSoga developers Team.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tarea
 *
 * @ORM\Table(name="tarea")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TareaRepository")
 */
class Tarea
{

    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="codigo_tarea_pk", type="integer", unique=true )
     */
    private $codigoTareaPk;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_usuario_registra_fk", type="string", length=50)
     */
    private $codigoUsuarioRegistraFk;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_tarea_tipo_fk", type="string", length=50, nullable=true)
     */
    private $codigoTareaTipoFk;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_verificado", type="datetime", nullable=true)
     */
    private $fechaVerificado;

    /**
     * @var bool
     *
     * @ORM\Column(name="estado_terminado", type="boolean", nullable=true)
     */
    private $estadoTerminado;

    /**
     * @var bool
     *
     * @ORM\Column(name="estado_verificado", type="boolean", nullable=true)
     */
    private $estadoVerificado;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_usuario_asigna_fk", type="string", length=50, nullable=true)
     */
    private $codigoUsuarioAsignaFk;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_gestion", type="datetime", nullable=true)
     */
    private $fechaGestion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solucion", type="datetime", nullable=true)
     */
    private $fechaSolucion;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=5000, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="string", length=5000, nullable=true)
     */
    private $comentario;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="caso", type="string", length=10, nullable=true)
	 */
	private $caso;

    /**
     * @ORM\ManyToOne(targetEntity="TareaTipo", inversedBy="tareasTareaTipoRel")
     * @ORM\JoinColumn(name="codigo_tarea_tipo_fk", referencedColumnName="codigo_tarea_tipo_pk")
     */
    private $tareaTipoRel;

    /**
     * Get codigoTareaPk
     *
     * @return integer
     */
    public function getCodigoTareaPk()
    {
        return $this->codigoTareaPk;
    }

    /**
     * Set codigoUsuarioRegistraFk
     *
     * @param string $codigoUsuarioRegistraFk
     *
     * @return Tarea
     */
    public function setCodigoUsuarioRegistraFk($codigoUsuarioRegistraFk)
    {
        $this->codigoUsuarioRegistraFk = $codigoUsuarioRegistraFk;

        return $this;
    }

    /**
     * Get codigoUsuarioRegistraFk
     *
     * @return string
     */
    public function getCodigoUsuarioRegistraFk()
    {
        return $this->codigoUsuarioRegistraFk;
    }

    /**
     * Set codigoTareaTipoFk
     *
     * @param string $codigoTareaTipoFk
     *
     * @return Tarea
     */
    public function setCodigoTareaTipoFk($codigoTareaTipoFk)
    {
        $this->codigoTareaTipoFk = $codigoTareaTipoFk;

        return $this;
    }

    /**
     * Get codigoTareaTipoFk
     *
     * @return string
     */
    public function getCodigoTareaTipoFk()
    {
        return $this->codigoTareaTipoFk;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return Tarea
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
     * Set fechaVerificado
     *
     * @param \DateTime $fechaVerificado
     *
     * @return Tarea
     */
    public function setFechaVerificado($fechaVerificado)
    {
        $this->fechaVerificado = $fechaVerificado;

        return $this;
    }

    /**
     * Get fechaVerificado
     *
     * @return \DateTime
     */
    public function getFechaVerificado()
    {
        return $this->fechaVerificado;
    }

    /**
     * Set estadoTerminado
     *
     * @param boolean $estadoTerminado
     *
     * @return Tarea
     */
    public function setEstadoTerminado($estadoTerminado)
    {
        $this->estadoTerminado = $estadoTerminado;

        return $this;
    }

    /**
     * Get estadoTerminado
     *
     * @return boolean
     */
    public function getEstadoTerminado()
    {
        return $this->estadoTerminado;
    }

    /**
     * Set estadoVerificado
     *
     * @param boolean $estadoVerificado
     *
     * @return Tarea
     */
    public function setEstadoVerificado($estadoVerificado)
    {
        $this->estadoVerificado = $estadoVerificado;

        return $this;
    }

    /**
     * Get estadoVerificado
     *
     * @return boolean
     */
    public function getEstadoVerificado()
    {
        return $this->estadoVerificado;
    }

    /**
     * Set codigoUsuarioAsignaFk
     *
     * @param string $codigoUsuarioAsignaFk
     *
     * @return Tarea
     */
    public function setCodigoUsuarioAsignaFk($codigoUsuarioAsignaFk)
    {
        $this->codigoUsuarioAsignaFk = $codigoUsuarioAsignaFk;

        return $this;
    }

    /**
     * Get codigoUsuarioAsignaFk
     *
     * @return string
     */
    public function getCodigoUsuarioAsignaFk()
    {
        return $this->codigoUsuarioAsignaFk;
    }

    /**
     * Set fechaGestion
     *
     * @param \DateTime $fechaGestion
     *
     * @return Tarea
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
     * @return Tarea
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Tarea
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
     * Set comentario
     *
     * @param string $comentario
     *
     * @return Tarea
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set tareaTipoRel
     *
     * @param \AppBundle\Entity\TareaTipo $tareaTipoRel
     *
     * @return Tarea
     */
    public function setTareaTipoRel(\AppBundle\Entity\TareaTipo $tareaTipoRel = null)
    {
        $this->tareaTipoRel = $tareaTipoRel;

        return $this;
    }

    /**
     * Get tareaTipoRel
     *
     * @return \AppBundle\Entity\TareaTipo
     */
    public function getTareaTipoRel()
    {
        return $this->tareaTipoRel;
    }

    /**
     * Set caso
     *
     * @param string $caso
     *
     * @return Tarea
     */
    public function setCaso($caso)
    {
        $this->caso = $caso;

        return $this;
    }

    /**
     * Get caso
     *
     * @return string
     */
    public function getCaso()
    {
        return $this->caso;
    }
}
