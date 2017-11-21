<?php

/**
 * Usuario class for Oro APP
 * developed by @ju4nr3v0l at appSoga development team
 */

namespace AppBundle\Entity\Usuario;


use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Role\Role;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 */
class Usuario implements UserInterface
{

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $codigoUsuarioPk;

    /**
     * @ORM\Column(type="string")
     */
    private $correo;

    /**
     * @ORM\Column(type="string")
     */
    private $nombres;

    /**
     * @ORM\Column(type="string")
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string")
     */
    private $clave;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verificado;

    /**
     * @ORM\Column(type="string")
     */
    private $token;

    /**
     * @ORM\Column(type="integer")
     */
    private $codigoClientePk;

    /**
     * @ORM\Column(type="integer")
     */
    private $codigoRol;

    

    /**
     * Se implementan métodos de la clase User del core de Symfony además de los metodos de la entidad própia.
     *
     */

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
        return $this->codigoRol;
    }

    /**
     * @param mixed $codigoRol
     */
    public function setCodigoRol($codigoRol)
    {
        $this->codigoRol = $codigoRol;
    }


}