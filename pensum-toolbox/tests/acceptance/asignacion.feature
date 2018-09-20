Feature: asignacion
  In order to plan my courses
  As a costumer
  I need to see the courses that i can take the next semester

  Scenario: try asignacion with prerequisites
  Given I want to see the courses
  When I try to see the courses if i approve Deportes uno
  Then I should be able to see the courses
