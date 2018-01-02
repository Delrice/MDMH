Feature: Restaurant administration
  In order to administrate restaurants
  As an admin
  I need to be able to create/update/delete restaurant

  Background:
    Given I am authenticated as "ROLE_ADMIN"
    And I am on "/"

  @fixtures @fixtures-restaurants
  Scenario: List available restaurants
    When I follow "menu.administrator.restaurants"
    Then I should see some "a.show-restaurant" elements

  @fixtures
  Scenario: Create new restaurant
    When I follow "menu.administrator.restaurants"
    And I follow "restaurants.create_new"
    And I fill in "restaurant[name]" with "addnewrestaurant"
    And I fill in "restaurant[identifier]" with "FAKEIDENTIFIER"
    And I press "restaurant.new.create_button"
    Then I should see "restaurant.new.success"
    And I should see "addnewrestaurant"

  @fixtures
  Scenario: Update restaurant
    Given There is 1 restaurant in database
    When I follow "menu.administrator.restaurants"
    And I follow "edit-restaurant-FAKEIDENTIFIER"
    And I fill in "restaurant[name]" with "iamupdated"
    And I press "restaurant.edit.create_button"
    Then I should see "restaurant.update.success"
    And I should see "iamupdated"
    But I should not see "editme"

  @fixtures @js
  Scenario: Remove restaurant
    Given There is 1 restaurant in database
    When I follow "menu.administrator.restaurants"
    And I follow "remove-restaurant-FAKEIDENTIFIER"
    And I follow "modal.delete.confirm"
    Then I should see "restaurant.delete.success"
    And I should see "restaurants.list.empty"
