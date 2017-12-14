Feature: Authentication
  In order to access website
  As an admin
  I need to be able to login and logout

  Background:
    Given I do not follow redirects
    And I am on "/"
    Then I should be redirected
    And I should see "user.login.title"

  Scenario Outline: Login
    When I fill in "login" with "<login>"
    When I fill in "password" with "<password>"
    When I press "LoginButton"
    Then I should see "<message>"

    Examples:
      | login | password | message |
      | fabrice | rightpassword | user.login.success |
      | fabrice | wrongpassword | user.login.failure |



