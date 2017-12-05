<?php
/**
 * Created by PhpStorm.
 * User: avera
 * Date: 4/12/17
 * Time: 11:10 AM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
* Caso
*
* @ORM\Table(name="caso")
* @ORM\Entity(repositoryClass="AppBundle\Repository\CasoRepository")
*/
class Caso
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="codigo_caso_pk", type="integer", unique=true)
     */
    private $codigoCasoPk;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=50)
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="contacto", type="string", length=100)
     */
    private $contacto;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=20)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=5)
     */
    private $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=5000)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable= TRUE)
     */
    private $fechaRegistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_gestion", type="datetime" ,nullable= TRUE)
     */
    private $fechaGestion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solucion", type="datetime" ,nullable= TRUE)
     */
    private $fechaSolucion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_categoria_caso_fk", type="string", length=50 ,nullable= TRUE)
     */
    private $codigoCategoriaCasoFk;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_usuario_atiende_fk", type="string", length=50 ,nullable= TRUE)
     */
    private $codigoUsuarioAtiendeFk;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_usuario_soluciona_fk", type="string", length=50 ,nullable= TRUE)
     */
    private $codigoUsuarioSolucionaFk;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado_atendido", type="boolean" ,nullable= TRUE)
     */
    private $estadoAtendido;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado_solucionado", type="boolean" ,nullable= TRUE)
     */
    private $estadoSolucionado;

    /**
     * @var int
     *
     * @ORM\Column(name="codigo_cliente_fk", type="integer" ,nullable= TRUE)
     */
    private $codigoClienteFk;

    /**
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="casosClienteRel")
     * @ORM\JoinColumn(name="codigo_cliente_fk", referencedColumnName="codigo_cliente_pk")
     */
    private $clienteRel;

    /**
     * Get codigoCasoPk
     *
     * @return integer
     */
    public function getCodigoCasoPk()
    {
        return $this->codigoCasoPk;
    }

    /**
     * Set asunto
     *
     * @param string $asunto
     *
     * @return Caso
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto
     *
     * @return string
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Set correo
     *
     * @param string $correo
     *
     * @return Caso
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
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Caso
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
     * @return Caso
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
     * @return Caso
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
     * @return Caso
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
     * @return Caso
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
     * @return Caso
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
     * Set codigoCategoriaCasoFk
     *
     * @param string $codigoCategoriaCasoFk
     *
     * @return Caso
     */
    public function setCodigoCategoriaCasoFk($codigoCategoriaCasoFk)
    {
        $this->codigoCategoriaCasoFk = $codigoCategoriaCasoFk;

        return $this;
    }

    /**
     * Get codigoCategoriaCasoFk
     *
     * @return string
     */
    public function getCodigoCategoriaCasoFk()
    {
        return $this->codigoCategoriaCasoFk;
    }

    /**
     * Set codigoUsuarioAtiendeFk
     *
     * @param string $codigoUsuarioAtiendeFk
     *
     * @return Caso
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
     * Set codigoUsuarioSolucionaFk
     *
     * @param string $codigoUsuarioSolucionaFk
     *
     * @return Caso
     */
    public function setCodigoUsuarioSolucionaFk($codigoUsuarioSolucionaFk)
    {
        $this->codigoUsuarioSolucionaFk = $codigoUsuarioSolucionaFk;

        return $this;
    }

    /**
     * Get codigoUsuarioSolucionaFk
     *
     * @return string
     */
    public function getCodigoUsuarioSolucionaFk()
    {
        return $this->codigoUsuarioSolucionaFk;
    }

    /**
     * Set estadoAtendido
     *
     * @param boolean $estadoAtendido
     *
     * @return Caso
     */
    public function setEstadoAtendido($estadoAtendido)
    {
        $this->estadoAtendido = $estadoAtendido;

        return $this;
    }

    /**
     * Get estadoAtendido
     *
     * @return boolean
     */
    public function getEstadoAtendido()
    {
        return $this->estadoAtendido;
    }

    /**
     * Set estadoSolucionado
     *
     * @param boolean $estadoSolucionado
     *
     * @return Caso
     */
    public function setEstadoSolucionado($estadoSolucionado)
    {
        $this->estadoSolucionado = $estadoSolucionado;

        return $this;
    }

    /**
     * Get estadoSolucionado
     *
     * @return boolean
     */
    public function getEstadoSolucionado()
    {
        return $this->estadoSolucionado;
    }

    /**
     * Set codigoClienteFk
     *
     * @param integer $codigoClienteFk
     *
     * @return Caso
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
     * @return Caso
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
     * Set contacto
     *
     * @param string $contacto
     *
     * @return Caso
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;

        return $this;
    }

    /**
     * Get contacto
     *
     * @return string
     */
    public function getContacto()
    {
        return $this->contacto;
    }
}
