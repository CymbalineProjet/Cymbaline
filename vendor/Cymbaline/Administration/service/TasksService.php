<?php
/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 23/05/2015
 * Time: 01:39
 */

namespace Cymbaline\Administration\service;

use core\component\dbmanager\SqlCommand;
use core\component\Service;
use Cymbaline\Administration\item\Tasks;

class TasksService extends Service {

    public function count_new() {
        $sqlCommand = new SqlCommand(new Tasks());
        $sqlCommand->setSelect('count(*) as nbre')
                   ->setWhere("flag = 0")
                   ->build();

        $datas = $sqlCommand->execute();

        return $datas[0]->nbre;

    }
}