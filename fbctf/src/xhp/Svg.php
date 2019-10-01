<?hh // strict

abstract class :xhp:svg-element extends :xhp:html-element {
  // We override this function to support SVG attributes containing colons.
  // See https://github.com/facebook/hhvm/issues/6947
  private function renderBaseAttrs_(): string {
    $buf = '<'.$this->tagName;
    foreach ($this->getAttributes() as $key => $val) {
      if ($val !== null && $val !== false) {
        $escaped_key = htmlspecialchars($key);
        if ($val === true) {
          $buf .= ' '.$escaped_key;
        } else {
          // This is our custom code to support SVG attributes. We only support the ones
          // we need, not the entire spec
          $svg_attrs = array(
            'xmlns' => array('amcharts', 'xlink'),
            'xlink' => array('href'),
          );
          foreach ($svg_attrs as $namespace => $attrs) {
            if (in_array($escaped_key, $attrs)) {
              $escaped_key = $namespace.':'.$escaped_key;
            }
          }
          $buf .=
            ' '.$escaped_key.'="'.htmlspecialchars($val, ENT_COMPAT).'"';
        }
      }
    }
    return $buf;
  }

  // We only override this function because we need to use the new version of `renderBaseAttrs`,
  // which could not be overriden because it was marked as final
  <<__Override>>
  protected function stringify(): string {
    $buf = $this->renderBaseAttrs_().'>';
    foreach ($this->getChildren() as $child) {
      $buf .= :xhp::renderChild($child);
    }
    $buf .= '</'.$this->tagName.'>';
    return $buf;
  }
}

class :svg extends :xhp:svg-element {
  attribute
    // We use relative widths for SVGs, so this is a string, not an int
    Stringish width,
    int height,
    Stringish xmlns,
    Stringish amcharts,
    Stringish xlink,
    Stringish viewBox,
    Stringish data-file,
    Stringish preserveAspectRatio;
  category %flow, %phrase;

  children (:use | :defs | :g)*;
  protected string $tagName = 'svg';
}

class :path extends :xhp:svg-element {
  attribute Stringish d;

  protected string $tagName = 'path';
}

class :use extends :xhp:svg-element {
  attribute
    // "xlink:" will be prepended before rendering
    Stringish href;

  protected string $tagName = 'use';
}

class :defs extends :xhp:svg-element {
  attribute Stringish d, Stringish transform;

  children (:amcharts:ammap)*;
  protected string $tagName = 'defs';
}

class :amcharts:ammap extends :xhp:svg-element {
  attribute
    Stringish projection,
    Stringish leftLongitude,
    Stringish topLatitude,
    Stringish rightLongitude,
    Stringish bottomLatitude;

  protected string $tagName = 'amcharts:ammap';
}

class :g extends :xhp:svg-element {
  attribute Stringish d, Stringish transform, Stringish data-captured;

  children (:path | :g)*;
  protected string $tagName = 'g';
}
