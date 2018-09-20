Feature: dashboard
  In order to use the platform
  As a customer
  I need to be able to see into the site

  Scenario: reprobar curso
  	Given I want to fail math1
    When I set push No Aprobar
    Then I should be able to dashboard 

  Scenario: aprobar curso
    Given I want to win math1
    When I set push Aprobar
    Then I should be able to dashboard 