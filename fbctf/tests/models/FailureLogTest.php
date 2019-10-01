<?hh

class FailureLogTest extends FBCTFTest {

	/**
	 * @covers FailureLog::genAllFailures
	 * @covers FailureLog::getId
	 */
  public function testAll(): void {
    $all = HH\Asio\join(FailureLog::genAllFailures());
    $this->assertEquals(2, count($all));

    $a = $all[0];
    $this->assertEquals(1, $a->getId());
    $this->assertEquals(1, $a->getTeamId());
    $this->assertEquals(1, $a->getLevelId());
    $this->assertEquals('flag', $a->getFlag());

    $a = $all[1];
    $this->assertEquals(2, $a->getId());
    $this->assertEquals(1, $a->getTeamId());
    $this->assertEquals(2, $a->getLevelId());
    $this->assertEquals('flag 2', $a->getFlag());
  }

  public function testAllByTeam(): void {
    $all = HH\Asio\join(FailureLog::genAllFailuresByTeam(1));
    $this->assertEquals(2, count($all));

    $a = $all[0];
    $this->assertEquals(1, $a->getId());
    $this->assertEquals(1, $a->getTeamId());
    $this->assertEquals(1, $a->getLevelId());
    $this->assertEquals('flag', $a->getFlag());

    $a = $all[1];
    $this->assertEquals(2, $a->getId());
    $this->assertEquals(1, $a->getTeamId());
    $this->assertEquals(2, $a->getLevelId());
    $this->assertEquals('flag 2', $a->getFlag());

    $all = HH\Asio\join(FailureLog::genAllFailuresByTeam(2));
    $this->assertEquals(0, count($all));
  }

	public function testResetFailures(): void {
    HH\Asio\join(FailureLog::genResetFailures());
    $all = HH\Asio\join(FailureLog::genAllFailuresByTeam(1));
    $this->assertEquals(0, count($all));
  }

	public function testLogFailedScore(): void {
    HH\Asio\join(FailureLog::genLogFailedScore(2, 3, 'flag 3'));
    $all = HH\Asio\join(FailureLog::genAllFailuresByTeam(3));
    $this->assertEquals(1, count($all));
    $all = HH\Asio\join(FailureLog::genAllFailuresByTeam(1));
    $this->assertEquals(2, count($all));
  }
}
