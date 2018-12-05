<?php

namespace App\Tests;

use App\Entity\Motcle;
use App\Entity\Exponent;
use PHPUnit\Framework\TestCase;

class MotcleTest extends TestCase
{
    public function testCreateMotcle()
    {
        $motcle = New Motcle();
        $motcle->setNameMc("outil");
        $this->assertNotNull($motcle->getNameMc());
        return $motcle;
    }

    public function testCreateExponent()
    {
        $exponent = New Exponent();
        $exponent->setNameExp("portier");
        $this->assertInternalType("string", $exponent->getNameExp());
        return $exponent;
    }
    
    public function testMotcleIntoExponent()
    {
        $exponent = $this->testCreateExponent();
        $motcle = $this->testCreateMotcle();
        $exponent->setMotcle($motcle);
        $this->assertInstanceOf(Motcle::class, $exponent->getMotcle());
    }
}
