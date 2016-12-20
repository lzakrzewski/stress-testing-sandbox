package wall

import io.gatling.core.Predef._
import io.gatling.http.Predef._
import scala.concurrent.duration._
import io.gatling.http.protocol.HttpProtocolBuilder
import io.gatling.core.structure.ScenarioBuilder
import scala.util.Properties.envOrNone

abstract class BaseSimulation extends Simulation
{
  def baseUrl(): String = {
    return nonEmptyEnvOrElse("APPLICATION_URL", "http://localhost:8000")
  }

  def duration(): Int = {
    return nonEmptyEnvOrElse("DURATION", "10").toInt
  }

  def usersLow(): Int = {
    return nonEmptyEnvOrElse("USERS_LOW", "1").toInt;
  }

  def usersHigh(): Int = {
    return nonEmptyEnvOrElse("USERS_HIGH", "10").toInt;
  }

  def nonEmptyEnvOrElse(name: String, alt: String): String = {
    return envOrNone(name).filter(_.trim.nonEmpty).getOrElse(alt)
  }
}
