<?hh // strict

abstract class AjaxController {
  abstract protected function getFilters(): array<string, mixed>;
  abstract protected function getActions(): array<string>;

  abstract protected function genHandleAction(
    string $action,
    array<string, mixed> $params,
  ): Awaitable<string>;

  public async function genHandleRequest(): Awaitable<string> {
    list($action, $params) = $this->processRequest();
    return await $this->genHandleAction($action, $params);
  }

  private function processRequest(): (string, array<string, mixed>) {
    $input_methods = array('POST' => INPUT_POST, 'GET' => INPUT_GET);
    $method = must_have_string(Utils::getSERVER(), 'REQUEST_METHOD');

    $filter = idx($this->getFilters(), $method);
    if ($filter === null) {
      // Method not supported
      return tuple('none', array());
    }

    $input_method = must_have_idx($input_methods, $method);
    $parameters = filter_input_array($input_method, $filter);

    $action = idx($parameters, 'action', 'main');
    if (!in_array($action, $this->getActions())) {
      $page = 'none';
    }

    return tuple($action, $parameters);
  }
}
