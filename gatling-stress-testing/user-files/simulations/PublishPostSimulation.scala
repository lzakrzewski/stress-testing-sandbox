package wall

import io.gatling.core.Predef._
import io.gatling.http.Predef._
import scala.concurrent.duration._

class PublishPostSimulation extends BaseSimulation
{
  object Wall {
    val wall = exec(http("Wall")
      .get("/"))
      .pause(1)
  }

  object PublishPost {
    val publish = exec(http("PublishPost")
      .post("/publish-post")
      .formParam("publisher", "${randomEmail}")
      .formParam("content", "${randomContent}"))
      .pause(1)
  }

  val httpConf = http
    .baseURL(baseUrl())
    .acceptHeader("${randomAcceptHeader}")
    .acceptLanguageHeader("${randomAcceptLanguageHeader}")
    .userAgentHeader("${randomUserAgentHeader}")

  val scn = scenario("PublishPostSimulation")
    .exec(
      _.set("randomEmail", Faker.randomEmail())
        .set("randomContent", Faker.randomContent())
        .set("randomAcceptHeader", Faker.randomAcceptHeader())
        .set("randomAcceptLanguageHeader", Faker.randomAcceptLanguageHeader())
        .set("randomUserAgentHeader", Faker.randomUserAgentHeader())
    ).exec(Wall.wall, PublishPost.publish)

  setUp(
    scn.inject(rampUsersPerSec(usersLow()) to (usersHigh()) during(duration() seconds))
  ).protocols(httpConf)
}