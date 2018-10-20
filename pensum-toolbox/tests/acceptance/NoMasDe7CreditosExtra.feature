Feature: NoMasDe7CreditosExtra
  In order to assign correctly the activities
  As a student
  I need to get less of seven credits in total

  Scenario: try NoMasDe7CreditosExtra
   Given I have a logged user in the page
   When I go to go to page of activities
   And I approves an activity
   Then I should a message of success
