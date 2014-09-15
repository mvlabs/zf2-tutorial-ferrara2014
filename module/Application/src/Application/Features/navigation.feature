Feature: Visit the About Page
    As a User
    I want to view the about page
    in order to find out about the project

Background:
    Given I go to the homepage

@nightly @wip
Scenario:
    When I follow "About"
    Then I should see the "About" page

@nightly
Scenario:
    When I follow "Find Out More Great Events..."
    Then I should see the "Events" page

   