Feature: User administration
  In order to grant access to other user
  As an admin
  I need to be able to create/update users

  Background:
    Given I am authenticated as "ROLE_ADMIN"
    And I am on "/"

  @fixtures
  Scenario: List available users
    When I follow "menu.administrator.users"
    Then I should see some "a.show-user" elements


