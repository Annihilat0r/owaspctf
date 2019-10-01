<?hh

class LinkTest extends FBCTFTest {

  public function testAllLinks(): void {
    $all = HH\Asio\join(Link::genAllLinks(1));
    $this->assertEquals(1, count($all));

    $l = $all[0];
    $this->assertEquals(1, $l->getId());
    $this->assertEquals(1, $l->getLevelId());
    $this->assertEquals('link', $l->getLink());
  }

  public function testCreateLink(): void {
    HH\Asio\join(Link::genCreate("link 2", 1));

    $all = HH\Asio\join(Link::genAllLinks(1));

    $this->assertEquals(2, count($all));

    $l = $all[1];
    $this->assertEquals(2, $l->getId());
    $this->assertEquals(1, $l->getLevelId());
    $this->assertEquals('link 2', $l->getLink());

    $l = $all[0];
    $this->assertEquals(1, $l->getId());
    $this->assertEquals(1, $l->getLevelId());
    $this->assertEquals('link', $l->getLink());
  }

  public function testUpdateLink(): void {
    HH\Asio\join(Link::genUpdate("link updated", 1, 1));

    $all = HH\Asio\join(Link::genAllLinks(1));

    $this->assertEquals(1, count($all));

    $l = $all[0];
    $this->assertEquals(1, $l->getId());
    $this->assertEquals(1, $l->getLevelId());
    $this->assertEquals('link updated', $l->getLink());
  }

  public function testDeleteLink(): void {
    HH\Asio\join(Link::genDelete(1));

    $all = HH\Asio\join(Link::genAllLinks(1));

    $this->assertEquals(0, count($all));
  }

  public function testGenLink(): void {
    $l = HH\Asio\join(Link::gen(1));

    $this->assertEquals(1, $l->getId());
    $this->assertEquals(1, $l->getLevelId());
    $this->assertEquals('link', $l->getLink());
  }

  public function testHasLinks(): void {
    $this->assertTrue(HH\Asio\join(Link::genHasLinks(1)));
    $this->assertFalse(HH\Asio\join(Link::genHasLinks(2)));
  }
}
