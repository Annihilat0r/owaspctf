<?hh

class ProgressiveTest extends FBCTFTest {

  public function testProgressiveScoreboard(): void {
    $all = HH\Asio\join(Progressive::genProgressiveScoreboard('team'));
    $this->assertEquals(1, count($all));

    $p = $all[0];
    $this->assertEquals(1, $p->getId());
    $this->assertEquals('team', $p->getTeamName());
    $this->assertEquals(10, $p->getPoints());
    $this->assertEquals(1, $p->getIteration());
  }

  public function testReset(): void {
    HH\Asio\join(Progressive::genReset());
    $all = HH\Asio\join(Progressive::genProgressiveScoreboard('team'));
    $this->assertEquals(0, count($all));
  }
}
