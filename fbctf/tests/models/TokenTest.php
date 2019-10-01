<?hh

class TokenTest extends FBCTFTest {

  public function testAll(): void {
    $all = HH\Asio\join(Token::genAllTokens());
    $this->assertEquals(2, count($all));

    $t = $all[0];
    $this->assertEquals(1, $t->getId());
    $this->assertFalse($t->getUsed());
    $this->assertEquals(1, $t->getTeamId());
    $this->assertEquals('token', $t->getToken());
    $this->assertEquals('2016-04-24 17:15:23', $t->getCreatedTs());

    $all = HH\Asio\join(Token::genAllAvailableTokens());
    $this->assertEquals(1, count($all));
  }

  public function testCreate(): void {
    // Creates 50 new tokens.
    HH\Asio\join(Token::genCreate());
    $all = HH\Asio\join(Token::genAllTokens());
    $this->assertEquals(52, count($all));
  }

  public function testDelete(): void {
    HH\Asio\join(Token::genDelete('token'));
    $all = HH\Asio\join(Token::genAllTokens());
    $this->assertEquals(1, count($all));
  }

  public function testCheck(): void {
    $check = HH\Asio\join(Token::genCheck('token'));
    $this->assertTrue($check);
    $check = HH\Asio\join(Token::genCheck('token 2'));
    $this->assertFalse($check);
  }

  public function testUse(): void {
    HH\Asio\join(Token::genUse('token', 3));
    $all = HH\Asio\join(Token::genAllTokens());
    $t = $all[0];
    $this->assertEquals(3, $t->getTeamId());
    $this->assertTrue($t->getUsed());
  }
}
