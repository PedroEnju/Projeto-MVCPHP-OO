<?php

/**
 *
 * @author Pedro Smith Enju
 */
class ControleMenu implements IPrivateTO {
    
    public function inicio() {
        $v = new TGui("inicio");
        $v->renderizar();
    }
    
}
