Feature: get_actividades_disponibles
  In order to assign an activity
  As a student
  I need to see a list of activities

  Scenario: try get_actividades_disponibles
   Given I have my number of carne is 209900909
   When I go to page of activities
   Then I should see all activities avaliables
