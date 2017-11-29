<?php

namespace AppBundle\Entity;



use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Role\Role;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 */
class Usuario implements UserInterface, \Serializable
{

    /**
     * @ORM\Column(type="string")
     * @ORM\Id
     */
    private $codigoUsuarioPk;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $correo;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $nombres;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $clave;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $verificado;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $token;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $codigoClientePk;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $codigoRol;


//
//    /**
//     * @ORM\ManyToOne(targetEntity="Rol", inversedBy="rolRel")
//     * @ORM\JoinColumn(name="codigoRol", referencedColumnName="codigoRolPk")
//     */
//    private $usuariosRol;



    /**
     * Se implementan métodos de la clase User del core de Symfony además de los metodos de la entidad própia.
     *
     */
    public function serialize()
    {
        return serialize(array(
                $this->codigoUsuarioPk,
                $this->clave
        ));
    }

    public function unserialize($serialized)
    {
        list(
                $this->codigoUsuarioPk,
                $this->clave

            ) = unserialize($serialized);
    }

    public function getUsername()
    {
        return $this->getCodigoUsuarioPk();
    }

    public function getRoles()
    {
        return ['ROLE_USER', 'ROLE_ADMIN'];
    }

    public function getPassword()
    {
        return $this->getClave();
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {

    }
    /**
     * end métodos de la clase User del core.
     */


    /**
     * Inicio de los metodos de la clase propia Usuario
     *
     *
     * @return mixed
     */
    public function getCodigoUsuarioPk()
    {
        return $this->codigoUsuarioPk;
    }

    /**
     * @param mixed $codigoUsuarioPk
     */
    public function setCodigoUsuarioPk($codigoUsuarioPk)
    {
        $this->codigoUsuarioPk = $codigoUsuarioPk;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @param mixed $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * @return mixed
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * @param mixed $nombres
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }

    /**
     * @return mixed
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * @param mixed $apellidos
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return mixed
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * @param mixed $clave
     */
    public function setClave($clave)
    {
        $this->clave = $clave;
    }

    /**
     * @return mixed
     */
    public function getVerificado()
    {
        return $this->verificado;
    }

    /**
     * @param mixed $verificado
     */
    public function setVerificado($verificado)
    {
        $this->verificado = $verificado;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getCodigoClientePk()
    {
        return $this->codigoClientePk;
    }

    /**
     * @param mixed $codigoClientePk
     */
    public function setCodigoClientePk($codigoClientePk)
    {
        $this->codigoClientePk = $codigoClientePk;
    }

    /**
     * @return mixed
     */
    public function getCodigoRol()
    {
        return array($this->roles);
    }

    /**
     * @param mixed $codigoRol
     */
    public function setCodigoRol($codigoRol)
    {
        $this->codigoRol = $codigoRol;
    }


    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuariosRol = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add usuariosRol
     *
     * @param \AppBundle\Entity\Rol $usuariosRol
     *
     * @return Usuario
     */
    public function addUsuariosRol(\AppBundle\Entity\Rol $usuariosRol)
    {
        $this->usuariosRol[] = $usuariosRol;

        return $this;
    }

    /**
     * Remove usuariosRol
     *
     * @param \AppBundle\Entity\Rol $usuariosRol
     */
    public function removeUsuariosRol(\AppBundle\Entity\Rol $usuariosRol)
    {
        $this->usuariosRol->removeElement($usuariosRol);
    }

    /**
     * Get usuariosRol
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuariosRol()
    {
        return array($this->roles);
        //return $this->usuariosRol;
    }

    /**
     * Set usuariosRol
     *
     * @param \AppBundle\Entity\Rol $usuariosRol
     *
     * @return Usuario
     */
    public function setUsuariosRol(\AppBundle\Entity\Rol $usuariosRol = null)
    {
        $this->usuariosRol = $usuariosRol;

        return $this;
    }
}
