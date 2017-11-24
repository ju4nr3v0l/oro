<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cliente
 *
 * @ORM\Table(name="cliente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClienteRepository")
 *
 */
class Cliente
{

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="codigoClientePk", type="integer", unique=true)
     */
    private $codigoClientePk;

    /**
     * @var string
     *
     * @ORM\Column(name="nit", type="string", length=11, nullable=true)
     */
    private $nit;

    /**
     * @var string
     *
     * @ORM\Column(name="razonSocial", type="string", length=255, nullable=true)
     */
    private $razonSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreComercial", type="string", length=255, nullable=true)
     */
    private $nombreComercial;

    /**
     * @ORM\ManyToOne(targetEntity="Llamada", inversedBy="llamadasCliente")
     * @ORM\JoinColumn(name="codigoClientePk", referencedColumnName="codigoClienteFk")
     */

    private $llamadasRel;


    /**
     * @ORM\OneToMany(targetEntity="Contacto", mappedBy="clienteRel")
     */
    private $contactosCliente;



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
     * Set codigoClientePk
     *
     * @param integer $codigoClientePk
     *
     * @return Cliente
     */
    public function setCodigoClientePk($codigoClientePk)
    {
        $this->codigoClientePk = $codigoClientePk;

        return $this;
    }

    /**
     * Get codigoClientePk
     *
     * @return int
     */
    public function getCodigoClientePk()
    {
        return $this->codigoClientePk;
    }

    /**
     * Set nit
     *
     * @param string $nit
     *
     * @return Cliente
     */
    public function setNit($nit)
    {
        $this->nit = $nit;

        return $this;
    }

    /**
     * Get nit
     *
     * @return string
     */
    public function getNit()
    {
        return $this->nit;
    }

    /**
     * Set razonSocial
     *
     * @param string $razonSocial
     *
     * @return Cliente
     */
    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;

        return $this;
    }

    /**
     * Get razonSocial
     *
     * @return string
     */
    public function getRazonSocial()
    {
        return $this->razonSocial;
    }

    /**
     * Set nombreComercial
     *
     * @param string $nombreComercial
     *
     * @return Cliente
     */
    public function setNombreComercial($nombreComercial)
    {
        $this->nombreComercial = $nombreComercial;

        return $this;
    }

    /**
     * Get nombreComercial
     *
     * @return string
     */
    public function getNombreComercial()
    {
        return $this->nombreComercial;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contactosCliente = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add contactosCliente
     *
     * @param \AppBundle\Entity\Contacto $contactosCliente
     *
     * @return Cliente
     */
    public function addContactosCliente(\AppBundle\Entity\Contacto $contactosCliente)
    {
        $this->contactosCliente[] = $contactosCliente;

        return $this;
    }

    /**
     * Remove contactosCliente
     *
     * @param \AppBundle\Entity\Contacto $contactosCliente
     */
    public function removeContactosCliente(\AppBundle\Entity\Contacto $contactosCliente)
    {
        $this->contactosCliente->removeElement($contactosCliente);
    }

    /**
     * Get contactosCliente
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContactosCliente()
    {
        return $this->contactosCliente;
    }

    /**
     * Set llamadasRel
     *
     * @param \AppBundle\Entity\Llamada $llamadasRel
     *
     * @return Cliente
     */
    public function setLlamadasRel(\AppBundle\Entity\Llamada $llamadasRel = null)
    {
        $this->llamadasRel = $llamadasRel;

        return $this;
    }

    /**
     * Get llamadasRel
     *
     * @return \AppBundle\Entity\Llamada
     */
    public function getLlamadasRel()
    {
        return $this->llamadasRel;
    }
}
