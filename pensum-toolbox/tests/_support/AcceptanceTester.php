<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

   /**
    * Define custom actions here
    */

    /**
     * @Given I want to signup
     */
    public function iWantToSignup()
    {
        $this->amOnPage("/index.php?r=site%2Fsignup");
        //throw new \Codeception\Exception\Incomplete("Step `I want to signup` is not defined");
    }

   /**
    * @When I set up a password with :num1 characters
    */
    public function iSetUpAPasswordWithCharacters($num1)
    {
        $pass = "";
        $count = intval($num1);
        while($count > 0){
            $pass .= "a";
            $count = $count - 1;
        } // while
        $this->fillField('Carnet', '1');
        $this->fillField('Nombres', 'TEST');
        $this->fillField('Apellidos', 'TEST');
        $this->fillField('Correo', 'test@mail.com');
        $this->fillField('Contrasena', $pass);
        $this->click('Submit');
        //throw new \Codeception\Exception\Incomplete("Step `I set up a password with :num1:num2 characters` is not defined");
    }

   /**
    * @Then I should be able to signup
    */
    public function iShouldBeAbleToSignup()
    {
        $this->See('Listado de Cursos');
        //throw new \Codeception\Exception\Incomplete("Step `I should be able to signup` is not defined");
    }

   /**
    * @Then I should not be able to signup
    */
    public function iShouldNotBeAbleToSignup()
    {
        $this->See('Submit');
        //throw new \Codeception\Exception\Incomplete("Step `I should not be able to signup` is not defined");
    }

    /**
     * @Given I want to see the courses
     */
     public function iWantToSeeTheCourses()
     {
         $this->amOnPage("/index.php?r=asignacion%2Findex");
         // throw new \Codeception\Exception\Incomplete("Step `I want to see the courses` is not defined");
     }

    /**
     * @When I try to see the courses if i approve Deportes uno
     */
     public function iTryToSeeTheCoursesIfIApproveDeportesUno()
     {
         $this->selectOption('cursos[]', array('text' => 'Deportes 1'));
         $this->click('Ver cursos siguientes');
         // throw new \Codeception\Exception\Incomplete("Step `I try to see the courses if i approve Deportes uno` is not defined");
     }

    /**
     * @Then I should be able to see the courses
     */
     public function iShouldBeAbleToSeeTheCourses()
     {
         $this->See('Deportes 2');
         // throw new \Codeception\Exception\Incomplete("Step `I should be able to see the courses` is not defined");
     }


}
