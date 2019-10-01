<?hh // strict

class RedirectException extends Exception {
  public function __construct(private string $path, private int $statusCode) {
    parent::__construct();
  }

  public function getPath(): string {
    return $this->path;
  }

  public function getStatusCode(): int {
    return $this->statusCode;
  }
}

class AdminRedirectException extends RedirectException {
  public function __construct() {
    parent::__construct('/index.php?p=admin', 302);
  }
}

class IndexRedirectException extends RedirectException {
  public function __construct() {
    parent::__construct('/index.php', 302);
  }
}

class RegistrationRedirectException extends RedirectException {
  public function __construct() {
    parent::__construct('/index.php?page=registration', 302);
  }
}

class LoginRedirectException extends RedirectException {
  public function __construct() {
    parent::__construct('/index.php?page=login', 302);
  }
}

class InternalErrorRedirectException extends RedirectException {
  public function __construct() {
    parent::__construct('/index.php?page=error', 500);
  }
}

class NotFoundRedirectException extends RedirectException {
  public function __construct() {
    parent::__construct('/error.php', 404);
  }
}

class GameRedirectException extends RedirectException {
  public function __construct() {
    parent::__construct('/index.php', 302);
  }
}
