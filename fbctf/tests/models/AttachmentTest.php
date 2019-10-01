<?hh

class AttachmentTest extends FBCTFTest {

  public function testAllAttachments(): void {
    $all = HH\Asio\join(Attachment::genAllAttachments(1));
    $this->assertEquals(1, count($all));

    $a = $all[0];
    $this->assertEquals(1, $a->getId());
    $this->assertEquals(1, $a->getLevelId());
    $this->assertEquals('filename', $a->getFilename());
  }

  public function testCreateInvalidAttachment(): void {
    HH\Asio\join(Attachment::genCreate("png", "doesnt_exist", 1));

    $all = HH\Asio\join(Attachment::genAllAttachments(1));
    $this->assertEquals(1, count($all));

    $a = $all[0];
    $this->assertEquals(1, $a->getId());
    $this->assertEquals(1, $a->getLevelId());
    $this->assertEquals('filename', $a->getFilename());
  }

  public function testUpdateAttachment(): void {
    HH\Asio\join(Attachment::genUpdate(1, 1, 'filename_new'));

    $all = HH\Asio\join(Attachment::genAllAttachments(1));
    $this->assertEquals(1, count($all));

    $a = $all[0];
    $this->assertEquals(1, $a->getId());
    $this->assertEquals(1, $a->getLevelId());
    $this->assertEquals('filename_new', $a->getFilename());
  }

  public function testGenAttachment(): void {
    $a = HH\Asio\join(Attachment::gen(1));

    $this->assertEquals(1, $a->getId());
    $this->assertEquals(1, $a->getLevelId());
    $this->assertEquals('filename', $a->getFilename());
  }

  public function testHasAttachments(): void {
    $this->assertTrue(HH\Asio\join(Attachment::genHasAttachments(1)));
    $this->assertFalse(HH\Asio\join(Attachment::genHasAttachments(2)));
  }

}
