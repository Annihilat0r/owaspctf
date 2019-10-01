<?hh

class AnnouncementTest extends FBCTFTest {

  public function testAllAnnouncements(): void {
    $all = HH\Asio\join(Announcement::genAllAnnouncements());
    $this->assertEquals(2, count($all));

    $a = $all[1];
    $this->assertEquals(1, $a->getId());
    $this->assertEquals('Hello buddy!', $a->getAnnouncement());
    $this->assertEquals('2016-04-24 17:15:23', $a->getTs());
  }

  public function testCreateAnnouncent(): void {
    HH\Asio\join(Announcement::genCreate('New'));
    $all = HH\Asio\join(Announcement::genAllAnnouncements());
    $this->assertEquals(3, count($all));

    $a = $all[0];
    $this->assertEquals(3, $a->getId());
    $this->assertEquals('New', $a->getAnnouncement());
  }

  public function testDeleteAnnouncement(): void {
    HH\Asio\join(Announcement::genDelete(1));
    $all = HH\Asio\join(Announcement::genAllAnnouncements());
    $this->assertEquals(1, count($all));

    $a = $all[0];
    $this->assertEquals(2, $a->getId());
    $this->assertEquals('I like it!', $a->getAnnouncement());
    $this->assertEquals('2016-04-26 12:14:20', $a->getTs());
  }
}
