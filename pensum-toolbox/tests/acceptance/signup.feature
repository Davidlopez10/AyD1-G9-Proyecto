Feature: signup
  In order to use the platform
  As a customer
  I need to be able to sign up into the site

  Rules:
  - The password should be 8 charcters at least

  Scenario: SignUp with a secure password
    Given I want to signup
    When I set up a password with 9 characters
    Then I should be able to signup

  Scenario: SignUp with a not secure password
    Given I want to signup
    When I set up a password with 6 characters
    Then I should not be able to signup
