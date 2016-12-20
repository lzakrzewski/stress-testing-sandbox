package wall

import io.gatling.core.Predef._
import io.gatling.http.Predef._
import scala.concurrent.duration._
import scala.util.Properties.envOrNone
import io.gatling.http.protocol.HttpProtocolBuilder
import java.util.UUID.randomUUID
import scala.util.Random

object Faker
{
  def randomElement(elements: Array[String]): String = {
    return Random.shuffle(elements.toList).head
  }

  def emails(): Array[String] = {
    return Array(
      "adams@aol.com", "lewis@att.net", "richardson@comcast.net", "tom@facebook.com", "mason@gmail.com", "miller@gmx.com", "johnson@googlemail.com",
      "morris@google.com", "wood@hotmail.com", "wright@hotmail.co.uk", "butler@mac.com", "davis@me.com", "knight@mail.com", "murphy@msn.com",
      "lee@live.com", "loyd@sbcglobal.net", "davies@verizon.net", "hunter@yahoo.com", "bailey@yahoo.co.uk",
      "young@email.com", "marshall@games.com", "marting@gmx.net", "jackson@hush.com", "clark@hushmail.com", "taylor@icloud.com", "fox@inbox.com",
      "hunt@lavabit.com", "graham@love.com", "gray@outlook.com", "edwards@pobox.com", "moore@rocketmail.com", "kate@yandex.com",
      "campbell@safe-mail.net", "carter@wow.com", "ellis@ygm.com", "evans@ymail.com", "mathias@zoho.com", "florence@fastmail.fm",
      "agnes@bellsouth.net", "julia@charter.net", "joan@comcast.net", "margaret@cox.net", "sally@earthlink.net", "sabina@juno.com",
      "rachel@btinternet.com", "rebecca@virginmedia.com", "tiffany@blueyonder.co.uk", "tina@freeserve.co.uk", "tracy@live.co.uk",
      "vycky@ntlworld.com", "poppy@o2.co.uk", "erin@orange.net", "eva@sky.com", "cox@talktalk.co.uk", "anderson@tiscali.co.uk",
      "isabel@virgin.net", "jade@wanadoo.co.uk", "matt@bt.com",
      "beth@sina.com", "abbie@qq.com", "amelia@naver.com", "natalie@hanmail.net", "natasha@daum.net", "sienna@nate.com", "dude@yahoo.co.jp", "chris@yahoo.co.kr", "manon@yahoo.co.id", "malic@yahoo.co.in", "greg@yahoo.com.sg", "andreas@yahoo.com.ph",
      "cloude@hotmail.fr", "marta@live.fr", "sarah@laposte.net", "mia@yahoo.fr", "mandy@wanadoo.fr", "grace@orange.fr", "nancy@gmx.fr", "hans@sfr.fr", "ruth@neuf.fr", "julien@free.fr",
      "candice@gmx.de", "edi@hotmail.de", "selina@live.de", "yvette@online.de", "stefan@t-online.de", "john@web.de", "cooper@yahoo.de",
      "carter@mail.ru", "chapman@rambler.ru", "richardson@yandex.ru", "romerts@ya.ru", "stewart@list.ru",
      "olivia@hotmail.be", "powell@live.be", "hill@skynet.be", "bailey@voo.be", "baker@tvcablenet.be", "anderson@telenet.be",
      "patel@hotmail.com.ar", "hunt@live.com.ar", "izac@yahoo.com.ar", "bill@fibertel.com.ar", "robert@speedy.com.ar", "elody@arnet.com.ar",
      "palmer@hotmail.com", "wilkinson@gmail.com", "wood@yahoo.com.mx", "smith@live.com.mx", "stevens@yahoo.com", "robertson@hotmail.es", "alex@live.com", "turner@hotmail.com.mx", "king@prodigy.net.mx", "marta@msn.com"
    )
  }

  def contents(): Array[String] = {
    return Array(
      "A bond speculates within the chalk!",
      "A behavior storms outside your rain.",
      "The chairman discriminates outside the supplier!",
      "When can the fence bash against the sudden worry?",
      "A taxpayer sings my isolate squad.",
      "The day pounds down upon the quest.",
      "Into the fifteen dirt pants the insignificant heroin.",
      "The antidote reacts without the principal!",
      "Each baggage laughs after an appearance!",
      "The static rain reacts to the prejudiced whole.",
      "An inhibited documentary puzzles on top of an accepted partner.",
      "Why can't a slim surface suspect?",
      "A rack prefaces the cubic misery.",
      "The laboratory complains without an assorted shock.",
      "The imported liberal allies an analyst.",
      "The grass matures throughout a contradictory hammer.",
      "A bacterium writes.",
      "My military performance pools a cold over the blest wreck.",
      "The mounted cube closets a footnote.",
      "The champagne stomachs the aspect.",
      "The prerequisite rockets!",
      "The metaphor undertakes a cleaned colleague.",
      "The ink breaks without the newsletter!",
      "My art discriminates the cult next to the asking helmet.",
      "An economy treats the heroic confine.",
      "Each treat bicycles on top of the sector.",
      "The bookstore reserves a searching premise within an architecture.",
      "Across a fish camps the corporate vicar.",
      "Under the green whim gossips the central peasant.",
      "A contest pretends the mercury below the participating fashion.",
      "When can each vain pose?",
      "How does a nick grant the legitimate territory?",
      "The effort expands inside the mathematician.",
      "The numeric analyst smokes opposite the plant.",
      "The exhausted pressure rants.",
      "Under the fine tourist fumes the parked consultant.",
      "The garble postulates the propaganda beneath the incident desire.",
      "Our anagram bobs past the load.",
      "The detail fudges after a wrath.",
      "How does the carriage die next to an advanced mechanic?",
      "The treasure accents a reactor.",
      "This species monkeys with the consent.",
      "The abolition hate snacks into a cyclist.",
      "The prominent bench brackets this unknown.",
      "Will a straw flower around the rushed fossil?",
      "How will an advance triumph?",
      "An enlightened gins the optimal bone.",
      "Another twin progresses before a preserved patience.",
      "Why won't the sermon pose as the clinical corridor?",
      "A sized trash trusts the otherwise spy.",
      "Should a tutorial glow throughout the simulate ally?",
      "The swamp assaults the distress.",
      "When can the cold smile underneath the comparative outcry?",
      "The originator rattles next to the insect.",
      "Its young declines without the obvious gift."
    )
  }

  def userAgents(): Array[String] = {
    return Array(
      "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:50.0) Gecko/20100101 Firefox/50.0",
      "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.100 Safari/537.36",
      "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36",
      "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0",
      "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_1) AppleWebKit/602.2.14 (KHTML, like Gecko) Version/10.0.1 Safari/602.2.14",
      "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.98 Safari/537.36"
    )
  }

  def randomAcceptLanguageHeader(): String = {
    return this.randomElement(
      Array(
        "en-US,en;q=0.5",
        "da, en-gb;q=0.8, en;q=0.7",
        "pl, en-us;q=0.7",
        "es-es",
        "en-US",
        "ru"
      )
    )
  }

  def randomAcceptHeader(): String = {
    return this.randomElement(
      Array(
        "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
        "application/xml,application/xhtml+xml,text/html;q=0.9, text/plain;q=0.8,image/png,*/*;q=0.5",
        "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
        "image/jpeg, application/x-ms-application, image/gif, application/xaml+xml, image/pjpeg, application/x-ms-xbap, application/x-shockwave-flash, application/msword, */*",
        "text/html, application/xml;q=0.9, application/xhtml+xml, image/png, image/webp, image/jpeg, image/gif, image/x-xbitmap, */*;q=0.1"
      )
    )
  }

  def randomEmail(): String = {
    return this.randomElement(this.emails())
  }

  def randomContent(): String = {
    return this.randomElement(this.contents())
  }

  def randomUserAgentHeader(): String = {
    return this.randomElement(this.userAgents())
  }
}