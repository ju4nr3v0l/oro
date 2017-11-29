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
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="codigo_rol_pk", type="integer", unique=true)
     */
    private $codigoRolPk;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;


//    /**
//     *
//     * ORM\OneToMany(targetEntity="Usuario", mappedBy="usuariosRol")
//     */
//
//    private $rolRel;

   
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
     * @return integer
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
}