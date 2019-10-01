<?hh

class CountryTest extends FBCTFTest {

  public function testUsedAdjust(): void {
    HH\Asio\join(Country::genUsedAdjust());
    $all = HH\Asio\join(Country::genAllCountriesForMap());

    $this->assertEquals(2, count($all));

    $c = $all[0];
    $this->assertTrue($c->getUsed());
  }

  public function testSetStatus(): void {
    HH\Asio\join(Country::genSetStatus(1, false));
    $c = HH\Asio\join(Country::gen(1));
    $this->assertFalse($c->getEnabled());
  }

  public function testAllCountries(): void {
    $all = HH\Asio\join(Country::genAllCountriesForMap());
    $this->assertEquals(2, count($all));

    $c = $all[0];
    $this->assertEquals(1, $c->getId());
    $this->assertEquals("BR", $c->getIsoCode());
    $this->assertEquals("Brazil", $c->getName());
    $this->assertTrue($c->getUsed());
    $this->assertTrue($c->getEnabled());
    $this->assertEquals("d", $c->getD());
    $this->assertEquals("transform", $c->getTransform());

    $all = HH\Asio\join(Country::genAllCountries());
    $this->assertEquals(2, count($all));
    $all = HH\Asio\join(Country::genAllCountriesForMap());
    $this->assertEquals(2, count($all));
    $all = HH\Asio\join(Country::genAllAvailableCountries());
    $this->assertEquals(0, count($all));
  }

  public function testIsActiveLevel(): void {
    $this->assertTrue(HH\Asio\join(Country::genIsActiveLevel(1)));
  }
}
