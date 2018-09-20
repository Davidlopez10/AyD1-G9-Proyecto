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
     * @Given I want to fail math:num1
     */
     public function iWantToFailMath($num1)
     {
         $this->amOnPage("/index.php?r=site%2Fno-aprobar-curso&codigo_curso=101");
         //throw new \Codeception\Exception\Incomplete("Step `I want to fail math:num1` is not defined");
     }



    /**
     * @When I set push No Aprobar
     */
     public function iSetPushNoAprobar()
     {
     	$this->See('Marcado como no aprobado el curso: 101 Mate Basica 1');
         //throw new \Codeception\Exception\Incomplete("Step `I set push No Aprobar` is not defined");
     }

    /**
     * @Given I want to win math:num1
     */
     public function iWantToWinMath($num1)
     {
     	 $this->amOnPage("/index.php?r=site%2Faprobar-curso&codigo_curso=101");
         //throw new \Codeception\Exception\Incomplete("Step `I want to win math:num1` is not defined");
         //http://localhost:8080/index.php?r=site%2Faprobar-curso&codigo_curso=101
     }

    /**
     * @When I set push Aprobar
     */
     public function iSetPushAprobar()
     {
     	 $this->See('Marcado como aprobado el curso: 101 Mate Basica 1');  
         //throw new \Codeception\Exception\Incomplete("Step `I set push Aprobar` is not defined");
     }

        /**
     * @Then I should be able to dashboard
     */
     public function iShouldBeAbleToDashboard()
     {
     	$this->See('Se actualiza dashboard');  
         //throw new \Codeception\Exception\Incomplete("Step `I should be able to dashboard` is not defined");
     }
}
