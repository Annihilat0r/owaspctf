<?hh

class CategoryTest extends FBCTFTest {

  public function testAllCategories(): void {
    $all = HH\Asio\join(Category::genAllCategories());
    $this->assertEquals(2, count($all));

    $c = $all[0];
    $this->assertEquals(1, $c->getId());
    $this->assertEquals('category 1', $c->getCategory());
    $this->assertEquals('2015-04-26 12:14:20', $c->getCreatedTs());

    $c = $all[1];
    $this->assertEquals(2, $c->getId());
    $this->assertEquals('category 2', $c->getCategory());
    $this->assertEquals('2016-04-26 12:14:20', $c->getCreatedTs());
  }

  public function testCreateCategory(): void {
    HH\Asio\join(Category::genCreate('category 3', false));
    $all = HH\Asio\join(Category::genAllCategories());
    $this->assertEquals(3, count($all));

    $c = $all[2];
    $this->assertEquals(3, $c->getId());
    $this->assertEquals('category 3', $c->getCategory());
    $this->assertFalse($c->getProtected());
  }

  public function testDeleteCategory(): void {
    HH\Asio\join(Category::genDelete(2));
    $all = HH\Asio\join(Category::genAllCategories());
    $this->assertEquals(1, count($all));

    $c = $all[0];
    $this->assertEquals(1, $c->getId());
    $this->assertEquals('category 1', $c->getCategory());
    $this->assertFalse($c->getProtected());
  }

  public function testUpdateCategory(): void {
    HH\Asio\join(Category::genUpdate('category new', 2));
    $all = HH\Asio\join(Category::genAllCategories());
    $this->assertEquals(2, count($all));

    $c = $all[1];
    $this->assertEquals(2, $c->getId());
    $this->assertEquals('category new', $c->getCategory());
    $this->assertFalse($c->getProtected());
  }

  public function testSingleCategory(): void {
    $c = HH\Asio\join(Category::genSingleCategory(2));

    $this->assertEquals(2, $c->getId());
    $this->assertEquals('category 2', $c->getCategory());
    $this->assertFalse($c->getProtected());
  }
}
