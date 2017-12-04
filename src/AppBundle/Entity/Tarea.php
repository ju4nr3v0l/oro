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
     * @ORM\Column(name="codigo_tarea_pk", type="integer", unique=true)
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
     * @var bool
     *
     * @ORM\Column(name="estado_terminado", type="boolean", nullable=true)
     */
    private $estadoTerminado;

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
     * @ORM\Column(name="descripcion", type="string", length=800, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="TareaTipo", inversedBy="tareasTareaTipoRel")
     * @ORM\JoinColumn(name="codigo_tarea_tipo_fk", referencedColumnName="codigo_tarea_tipo_pk")
     */
    private $tareaTipoRel;

    /**
     * Set codigoTareaPk
     *
     * @param integer $codigoTareaPk
     *
     * @return Tarea
     */
    public function setCodigoTareaPk($codigoTareaPk)
    {
        $this->codigoTareaPk = $codigoTareaPk;

        return $this;
    }

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
}
