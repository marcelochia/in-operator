<?php

namespace MarceloChia\Tests;

use MarceloChia\InOperator;
use PHPUnit\Framework\TestCase;

class InOperatorTest extends TestCase
{
    public function testOperatorInShouldReturnAnEmptyParentheses(): void
    {
        $users = [];
        
        $this->assertEquals("('')", InOperator::create($users,'users'));
    }

    public function testOperatorInShouldReturnContentWithoutQuotationMarks(): void
    {
        $usersId = [1,2,3];

        $this->assertEquals("(1,2,3)", InOperator::create($usersId,'users'));
    }

    public function testOperatorInShouldReturnContentWithQuotationMarks(): void
    {
        $users = ['Anna', 'Bryan', 'Carl'];

        $this->assertEquals("('Anna','Bryan','Carl')", InOperator::create($users,'users',true));
    }

    public function testOperatorInShouldReturnInTwoConditionsWithoutQuotationMarks()
    {
        $usersId = [];
        for ($i=1; $i <= 20; $i++) { 
            $usersId[] = $i;
        }

        $this->assertEquals("(1,2,3,4,5,6,7,8,9,10) or users in (11,12,13,14,15,16,17,18,19,20)", 
            InOperator::create($usersId,'users'));
    }

    public function testOperatorInShouldReturnInTwoConditionsWithQuotationMarks()
    {
        $usersCod = [];
        for ($i=1; $i <= 20; $i++) { 
            $usersCod[] = $i;
        }

        $this->assertEquals("('1','2','3','4','5','6','7','8','9','10') or users in ('11','12','13','14','15','16','17','18','19','20')", 
            InOperator::create($usersCod,'users',true));
    }
}
