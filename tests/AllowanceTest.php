<?php
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AllowanceTest extends TestCase
{

  /*
  * 1. Create
  */

  // Test Checklist Create
  public function testPerson1()
  {
    $paramsText ='{"total_children":"2","age_children":[10,15],"basic_sallary":350000}';
    $params = json_decode($paramsText, true);

    $this->post('/allowance', $params);
    
    $this->seeStatusCode(200);

    $this->seeJsonStructure([
            'data'=>[
              'basic_sallary',
              'allowances'=> [
                '*'=>[
                  'age',
                  'percentage',
                  'allowance'
                ]
              ],
              'total_allowance',
              'total_sallary'
            ]
          ]   
        );

    $this->seeJson([
        'status' => true
      ]);
  }

  public function testPerson2()
  {
    $paramsText ='{"total_children":"0","basic_sallary":270000}';
    $params = json_decode($paramsText, true);

    $this->post('/allowance', $params);
    
    $this->seeStatusCode(200);


    $this->seeJsonStructure([
            'data'=>[
              'basic_sallary',
              'allowances'=> [
                '*'=>[
                  'age',
                  'percentage',
                  'allowance'
                ]
              ],
              'total_allowance',
              'total_sallary'
            ]
          ]   
        );

    $this->seeJson([
        'status' => true
      ]);
  }

  public function testPerson3()
  {
    $paramsText ='{"total_children":"4","age_children":[3,5,13,14],"basic_sallary":500000}';
    $params = json_decode($paramsText, true);

    $this->post('/allowance', $params);
    
    $this->seeStatusCode(200);

    $this->seeJsonStructure([
            'data'=>[
              'basic_sallary',
              'allowances'=> [
                '*'=>[
                  'age',
                  'percentage',
                  'allowance'
                ]
              ],
              'total_allowance',
              'total_sallary'
            ]
          ]   
        );

    $this->seeJson([
        'status' => true
      ]);
  }

  public function testPerson4()
  {
    $paramsText ='{"total_children":"","age_children":[6],"basic_sallary":40000}';
    $params = json_decode($paramsText, true);

    $this->post('/allowance', $params);
    
    $this->seeStatusCode(400);


    $this->seeJsonStructure([
            'message',
            'status',
            'error'
        ]);
    $this->seeJson([
        'status' => false
      ]);
  }

}
