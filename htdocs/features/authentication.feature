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
      | ROLE_ADMIN | ROLE_ADMIN | user.login.success |
      | ROLE_ADMIN | ROLE_ADMINN | user.login.failure |

  Scenario Outline: Roles
    When I fill in "login" with "<login>"
    When I fill in "password" with "<password>"
    When I press "LoginButton"
    Then I should see "<menu>"
    And I should not see "<nomenu>"

    Examples:
      | login      | password   | menu               | nomenu              |
      | ROLE_ADMIN | ROLE_ADMIN | menu.administrator | menu.administratorr |
      | ROLE_USERS | ROLE_USERS | menu.restaurants   | menu.administrator  |

