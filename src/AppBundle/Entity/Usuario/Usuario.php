<?php

namespace AppBundle\Entity\Usuario;

/**
 * Usuario
 */
class Usuario
{
    /**
     * @var string
     */
    private $codigoUsuarioPk;

    /**
     * @var string
     */
    private $correo;

    /**
     * @var string
     */
    private $nombres;

    /**
     * @var string
     */
    private $apellidos;

    /**
     * @var string
     */
    private $clave;

    /**
     * @var boolean
     */
    private $verificado;

    /**
     * @var string
     */
    private $token;

    /**
     * @var integer
     */
    private $codigoClientePk;

    /**
     * @var integer
     */
    private $codigoRol;


    /**
     * Set codigoUsuarioPk
     *
     * @param string $codigoUsuarioPk
     *
     * @return Usuario
     */
    public function setCodigoUsuarioPk($codigoUsuarioPk)
    {
        $this->codigoUsuarioPk = $codigoUsuarioPk;

        return $this;
    }

    /**
     * Get codigoUsuarioPk
     *
     * @return string
     */
    public function getCodigoUsuarioPk()
    {
        return $this->codigoUsuarioPk;
    }

    /**
     * Set correo
     *
     * @param string $correo
     *
     * @return Usuario
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set nombres
     *
     * @param string $nombres
     *
     * @return Usuario
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get nombres
     *
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Usuario
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set clave
     *
     * @param string $clave
     *
     * @return Usuario
     */
    public function setClave($clave)
    {
        $this->clave = $clave;

        return $this;
    }

    /**
     * Get clave
     *
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set verificado
     *
     * @param boolean $verificado
     *
     * @return Usuario
     */
    public function setVerificado($verificado)
    {
        $this->verificado = $verificado;

        return $this;
    }

    /**
     * Get verificado
     *
     * @return boolean
     */
    public function getVerificado()
    {
        return $this->verificado;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return Usuario
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set codigoClientePk
     *
     * @param integer $codigoClientePk
     *
     * @return Usuario
     */
    public function setCodigoClientePk($codigoClientePk)
    {
        $this->codigoClientePk = $codigoClientePk;

        return $this;
    }

    /**
     * Get codigoClientePk
     *
     * @return integer
     */
    public function getCodigoClientePk()
    {
        return $this->codigoClientePk;
    }

    /**
     * Set codigoRol
     *
     * @param integer $codigoRol
     *
     * @return Usuario
     */
    public function setCodigoRol($codigoRol)
    {
        $this->codigoRol = $codigoRol;

        return $this;
    }

    /**
     * Get codigoRol
     *
     * @return integer
     */
    public function getCodigoRol()
    {
        return $this->codigoRol;
    }
}

