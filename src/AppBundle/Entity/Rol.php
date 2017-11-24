<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rol
 *
 * @ORM\Table(name="rol")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RolRepository")
 */
class Rol
{

    /**
     * @var int
     *
     * @ORM\Column(name="codigoRolPk", type="integer", unique=true)
     */
    private $codigoRolPk;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;


    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="UsuariosRol")
     * @ORM\JoinColumn(name="codigoRolFk", referencedColumnName="codigoRolPk")
     */

    private $rolRel;

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
     * Set codigoRolPk
     *
     * @param integer $codigoRolPk
     *
     * @return Rol
     */
    public function setCodigoRolPk($codigoRolPk)
    {
        $this->codigoRolPk = $codigoRolPk;

        return $this;
    }

    /**
     * Get codigoRolPk
     *
     * @return int
     */
    public function getCodigoRolPk()
    {
        return $this->codigoRolPk;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Rol
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
     * Set rolRel
     *
     * @param \AppBundle\Entity\Usuario $rolRel
     *
     * @return Rol
     */
    public function setRolRel(\AppBundle\Entity\Usuario $rolRel = null)
    {
        $this->rolRel = $rolRel;

        return $this;
    }

    /**
     * Get rolRel
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getRolRel()
    {
        return $this->rolRel;
    }
}
