Feature: Visit the About Page
    As a User
    I want to view the about page
    in order to find out about the project
    
Scenario:
    Given I go to the homepage
    When I follow "About"
    Then I should see the "About" page

Scenario:
    Given I go to the homepage
    When I follow "Find Out More Great Events..."
    Then I should see the "Event" page

   