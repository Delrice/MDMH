Feature: User administration
  In order to grant access to other user
  As an admin
  I need to be able to create/update users

  Background:
    Given I am authenticated as "ROLE_ADMIN"
    And I am on "/"
    And there are 5 users

  Scenario: List available users
    When I follow "menu.administrator.users"
    Then I should see 5 "show-user" elements


