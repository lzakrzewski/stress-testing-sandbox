Feature: Publish post

  Scenario: Publish post
    Given I am a visitor
     When I publish post with id "d01b71a7-f78f-47ff-95fd-5b25c96b8028"
     Then I post with id "d01b71a7-f78f-47ff-95fd-5b25c96b8028" should be published