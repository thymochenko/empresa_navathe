<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PetTest
 *
 * @author thymo
 */
use Silex\WebTestCase;

abstract class PetTest extends WebTestCase {
    //put your code here
    
    public function testCreatePet(){
        $client = $this->createClient();
        $client->request('GET', 'pet/create');
        $this->assertTrue($client->getResponse()->isOk());
    }
}
