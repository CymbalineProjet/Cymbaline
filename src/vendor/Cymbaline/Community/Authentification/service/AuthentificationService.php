<?php

namespace Cymbaline\Community\Authentification\service;

use core\component\Service;

/**
 * Description of AuthentificationService
 *
 * @author Thibault
 */
class AuthentificationService extends Service {

    public function is_authentified() {
        $session = $this->getSession();

        if($session->_is_register('security.community.member')) {
            $auth = $session->get('security.community.member');
            if($auth['is_secured']) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function is_anonymous() {
        $session = $this->getSession();

        if($session->_is_register('security.community.member')) {
            $auth = $session->get('security.community.member');
            if($auth['is_anonymous']) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function is_granted() {
        $session = $this->getSession();

        if($session->_is_register('security.community.member')) {
            $auth = $session->get('security.community.member');

            if($auth['is_granted']) {
                return true;
            } else {
                return false;
            }
        } else {

            return false;
        }
    }

}
