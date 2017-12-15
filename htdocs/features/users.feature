Feature: User administration
  In order to grant access to other user
  As an admin
  I need to be able to create/update users

  Background:
    Given I am authenticated as "ROLE_ADMIN"
    And I am on "/"

  @fixtures @fixtures-users
  Scenario: List available users
    When I follow "menu.administrator.users"
    Then I should see some "a.show-user" elements

  Scenario: Create new user
    When I follow "menu.administrator.users"
    And I follow "users.create_new"
    And I fill in "user_creation_form[username]" with "addnewusername"
    And I fill in "user_creation_form[email]" with "email@email.fr"
    And I fill in "user_creation_form[plainPassword][first]" with "password"
    And I fill in "user_creation_form[plainPassword][second]" with "password"
    And I select "ROLE_ADMIN" from "user_creation_form[accessRole]"
    And I press "user.new.create_button"
    Then I should see "user.new.success"
    And I should see "addnewusername"

