Feature: User administration
  In order to grant access to other user
  As an admin
  I need to be able to create/update/delete users

  Background:
    Given I am authenticated as "ROLE_ADMIN"
    And I am on "/"

  @fixtures @fixtures-users
  Scenario: List available users
    When I follow "menu.administrator.users"
    Then I should see some "a.show-user" elements

  @fixtures
  Scenario: Create new user
    When I follow "menu.administrator.users"
    And I follow "users.create_new"
    And I fill in "user_creation[username]" with "addnewusername"
    And I fill in "user_creation[email]" with "email@email.fr"
    And I fill in "user_creation[plainPassword][first]" with "password"
    And I fill in "user_creation[plainPassword][second]" with "password"
    And I select "ROLE_ADMIN" from "user_creation[access_role]"
    And I press "user.new.create_button"
    Then I should see "user.new.success"
    And I should see "addnewusername"

  @fixtures
  Scenario: Update user
    Given There is 1 user in database
    When I follow "menu.administrator.users"
    And I follow "edit-user-editme"
    And I fill in "user_edition[username]" with "iamupdated"
    And I press "user.edit.create_button"
    Then I should see "user.update.success"
    And I should see "iamupdated"
    But I should not see "editme"

  @fixtures @js
  Scenario: Remove user
    Given There is 1 user in database
    When I follow "menu.administrator.users"
    And I follow "remove-user-editme"
    And I follow "modal.delete.confirm"
    Then I should see "user.delete.success"
    And I should see "users.list.empty"
