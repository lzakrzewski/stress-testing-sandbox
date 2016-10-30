Feature: Publish post

  Scenario: Publish post
    Given I am a publisher with email "john@doe.com"
     When I publish post with id "d01b71a7-f78f-47ff-95fd-5b25c96b8028" and content "Hello world!"
     Then I should be notified that post was published
      And I post with id "d01b71a7-f78f-47ff-95fd-5b25c96b8028" should be published

  Scenario: Publish post without email provided
     When I publish post with id "d01b71a7-f78f-47ff-95fd-5b25c96b8028" and content "Hello world!"
     Then I should be notified that post is invalid
      And I post with id "d01b71a7-f78f-47ff-95fd-5b25c96b8028" should not be published

  Scenario: Publish post without content provided
    Given I am a publisher with email "john@doe.com"
     When I publish post with id "d01b71a7-f78f-47ff-95fd-5b25c96b8028" and content ""
     Then I should be notified that post is invalid
      And I post with id "d01b71a7-f78f-47ff-95fd-5b25c96b8028" should not be published