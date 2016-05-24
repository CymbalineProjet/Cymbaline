<?php
/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 23/05/2015
 * Time: 00:55
 */

namespace Cymbaline\Generator\interfaces;


interface ItemCRUD {
    public function getId();
    public function setId($i);
}