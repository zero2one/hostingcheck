<?php
/**
 * Tests for Hostingcheck_Results class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Results_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the constructor.
     */
    public function testConstructor()
    {
        $results = new Hostingcheck_Results();
        $this->assertCount(0, $results);
    }

    /**
     * Test the iterator functionality.
     */
    public function testSeekable()
    {
        $scenario = new Hostingcheck_Scenario(array());
        $results = new Hostingcheck_Results($scenario);

        // Add some group results.
        $group1 = $this->createGroupResults('group1', 'Group 1');
        $results->add($group1);
        $group2 = $this->createGroupResults('group2', 'Group 2');
        $results->add($group2);
        $group3 = $this->createGroupResults('group3', 'Group 3');
        $results->add($group3);

        // Countable.
        $this->assertCount(3, $results);

        // First element should be by default group1.
        $this->assertEquals($group1, $results->current());
        $this->assertEquals('group1', $results->key());
        $this->assertTrue($results->valid());

        // Go to the next group, that should be group2.
        $results->next();
        $this->assertEquals('group2', $results->key());
        $this->assertEquals($group2, $results->current());

        // Seek a specific group by its machine name.
        $this->assertEquals($group3, $results->seek('group3'));


        // A non existing machine name should return null.
        $this->assertNull($results->seek('FooBar'));

        // Go to group3.
        $results->next();
        $this->assertTrue($results->valid());

        // Go to next, not valid element.
        $results->next();
        $this->assertFalse($results->valid());

        // Test foreach loop.
        $results->rewind();
        $i = 1;
        foreach ($results as $name => $group) {
            $this->assertEquals('group' . $i, $name);
            $i++;
        }
    }

    /**
     * Test the test count functionality.
     */
    public function testTestsCount()
    {
        $results = new Hostingcheck_Results();
        $this->assertEquals(0, $results->countTests());
        $this->assertEquals(0, $results->countTestsInfo());
        $this->assertEquals(0, $results->countTestsSuccess());
        $this->assertEquals(0, $results->countTestsFailure());
        $this->assertEquals(0, $results->countTestsValidations());

        $group1 = $this->createGroupResults('group1', 'Group 1');
        $group1->tests()->add($this->createTestResult('info'));
        $group1->tests()->add($this->createTestResult('success'));

        $group2 = $this->createGroupResults('group2', 'Group 2');
        $group2->tests()->add($this->createTestResult('info'));
        $group2->tests()->add($this->createTestResult('success'));
        $group2->tests()->add($this->createTestResult('failure'));
        $group2->tests()->add($this->createTestResult('failure'));
        $group2->tests()->add($this->createTestResult('failure'));


        $results->add($group1);
        $results->add($group2);

        //$this->assertEquals(7, $results->countTests());
        $this->assertEquals(2, $results->countTestsInfo());
        $this->assertEquals(2, $results->countTestsSuccess());
        $this->assertEquals(3, $results->countTestsFailure());
        $this->assertEquals(5, $results->countTestsValidations());
    }

    /**
     * Create a new group scenario.
     *
     * @param string $name
     *     The machine name.
     * @param string $title
     *     The human name.
     *
     * @return Hostingcheck_Results_Group
     */
    protected function createGroupResults($name, $title)
    {
        $scenario = new Hostingcheck_Scenario_Group(
            $name,
            $title,
            new Hostingcheck_Scenario_Tests()
        );

        $results = new Hostingcheck_Results_Group($scenario);
        return $results;
    }

    /**
     * Create a dummy Hostingcheck_Results_Test() object.
     *
     * @param string $resultType
     *     The result type (info|success|failure) to include in the test result.
     *
     * @return Hostingcheck_Results_Test
     */
    protected function createTestResult($resultType = 'info')
    {
        $name = md5(mt_rand(0, 5000) . time());

        $scenario = new Hostingcheck_Scenario_Test(
            $name,
            new Hostingcheck_Info_Text(),
            new Hostingcheck_Scenario_Validators(),
            new Hostingcheck_Scenario_Tests()
        );

        switch ($resultType) {
            case 'success':
                $result = new Hostingcheck_Result_Success();
                break;

            case 'failure':
                $result = new Hostingcheck_Result_Failure();
                break;

            default:
                $result = new Hostingcheck_Result_Info();
                break;
        }

        $testResult = new Hostingcheck_Results_Test(
            $scenario,
            $scenario->info(),
            $result,
            new Hostingcheck_Results_Tests()
        );

        return $testResult;
    }
}
