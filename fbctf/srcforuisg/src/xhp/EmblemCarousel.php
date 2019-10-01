<?hh // strict

class :emblem-carousel extends :x:element {
  category %flow;

  protected string $tagName = 'emblem-carousel';

  protected function render(): XHPRoot {
    $logos_div = <div class="fb-container container--large"></div>;
    $logos_ul = <ul class="fb-slider slides"></ul>;

    $logos = HH\Asio\join(Logo::genAllEnabledLogos());
    foreach ($logos as $logo) {
      $xlink_href = '#icon--badge-'.$logo->getName();
      $logos_ul->appendChild(
        <li>
          <svg class="icon--badge">
            <use href={$xlink_href}></use>
          </svg>
        </li>
      );
    }

    $logos_div->appendChild($logos_ul);
    return $logos_div;
  }
}
