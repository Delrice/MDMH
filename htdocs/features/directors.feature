Feature: Restaurant daily work
  In order to work daily on restaurant
  As a director
  I need to be able to enter daily sales, annual budget and view tracking sales

  Background:
    Given I am authenticated as "ROLE_USERS"
    And I am on "/"

  @fixtures @fixtures-dailysales
  Scenario: Create a new budget
    When I follow "menu.restaurant.budget"
    And I follow "restaurant.create.budget.year"
    And I fill in "budget[jan]" with "10000"
    And I fill in "budget[feb]" with "20000"
    And I fill in "budget[mar]" with "30000"
    And I press "restaurant.budget.new.create_button"
    Then I should see "restaurant.budget.new.success"
    And I should see "month-jan"
    And I should see "10 000"
    And I should see "month-feb"
    And I should see "20 000"
    And I should see "month-mar"
    And I should see "30 000"
    And I should see "60 000"

  @fixtures @fixtures-dailysales
  Scenario: Add DailySales
    When I follow "menu.restaurant.daily_sales"
    And I fill in "monthly_sales[dailySales][1][budgetAmount]" with "5000"
    And I fill in "monthly_sales[dailySales][1][foodSaleAmount]" with "5000"
    And I press "restaurant.daily_sales.edit.create_button"
    Then I should see "restaurant.daily_sales.update.success"