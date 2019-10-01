<?hh // strict

require_once ($_SERVER['DOCUMENT_ROOT'].'/../vendor/autoload.php');

class WorldViewMapController {
  public function __construct(private bool $viewmode) {}

  public async function genRender(): Awaitable<:xhp> {
    if ($this->viewmode) {
      $worldMap = await $this->genRenderWorldMapView();
    } else {
      $worldMap = $this->renderWorldMap();
    }
    return
      <svg
        id="fb-gameboard-map"
        xmlns="http://www.w3.org/2000/svg"
        amcharts="http://amcharts.com/ammap"
        xlink="http://www.w3.org/1999/xlink"
        viewBox="0 0 1008 651"
        preserveAspectRatio="xMidYMid meet">
        <defs>
          <amcharts:ammap
            projection="mercator"
            leftLongitude="-169.6"
            topLatitude="83.68"
            rightLongitude="190.25"
            bottomLatitude="-55.55">
          </amcharts:ammap>
        </defs>
        <g class="view-controller">
          <g class="countries">
            {$worldMap}
          </g>
          <g class="country-hover"></g>
        </g><!-- view-controller -->
      </svg>;
  }

  public function renderWorldMap(): :xhp {
    $svg_countries = <g class="countries"></g>;
    return $svg_countries;
  }

  public async function genRenderWorldMapView(): Awaitable<:xhp> {
    $svg_countries = <g class="countries"></g>;
    $all_map_countries = await Country::genAllCountriesForMap();
    foreach ($all_map_countries as $country) {
      $is_active_level = await Country::genIsActiveLevel($country->getId());
      $path_class =
        ($country->getUsed() && $is_active_level) ? 'land active' : 'land';

      $svg_countries->appendChild(
        <g>
          <path
            id={$country->getIsoCode()}
            title={$country->getName()}
            class={$path_class}
            d={$country->getD()}>
          </path>
          <g transform={$country->getTransform()} class="map-indicator">
            <path d="M0,9.1L4.8,0h0.1l4.8,9.1v0L0,9.1L0,9.1z"></path>
          </g>
        </g>
      );
    }

    return $svg_countries;
  }
}

/* HH_IGNORE_ERROR[1002] */
$viewmodepage = new WorldViewMapController(true);
echo \HH\Asio\join($viewmodepage->genRender());
