Feature: Add post

  Scenario: Add post to a wall
    Given I am a visitor
     When I add post to a wall
     Then I should be notified that post was added to a wall