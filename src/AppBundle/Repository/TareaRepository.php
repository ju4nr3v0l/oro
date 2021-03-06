<?php

namespace AppBundle\Repository;

/**
 * TareaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TareaRepository extends \Doctrine\ORM\EntityRepository
{


    public function listaDql($estado = "")
    {
        $em = $this->getEntityManager();
        $db = $em->createQueryBuilder()->from("AppBundle:Tarea", "t")
            ->select("t")
            ->andwhere("t.codigoTareaPk <> 0")
            ->orderBy("t.estadoTerminado", "ASC")
            ->addOrderBy("t.estadoVerificado", "ASC")
            ->addOrderBy("t.fechaRegistro", "DESC");
        if ($estado == 0) {
            $db->andWhere("t.estadoTerminado = 0");
        }
        if ($estado == 1) {
            $db->andWhere("t.estadoTerminado = 1");
        }


        return $db;

    }

}
