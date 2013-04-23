<?php
  /**
   * examples:
   * //Style preference, persists only until the browser is closed
   * Cookie::Set('style', 'black_and_orange', Cookie::Session);
   * //Remember the users email address to pre-fill the login form when they return
   * Cookie::Set('rememberme', 'email@domain.com', Cookie::ThirtyDays);
   * //Tracking cookie that effectively lasts forever
   * Cookie::Set('tracking', 'sdfoiwuyo8who8wfhow8fhso4', Cookie::Lifetime, '/', '.domain.com');
   */
class Cookie {
  const Session = null;
  const OneDay = 86400;
  const SevenDays = 604800;
  const ThirtyDays = 2592000;
  const SixMonths = 15811200;
  const OneYear = 31536000;
  const Lifetime = -1; // 2030-01-01 00:00:00

  /**
   * Returns true if there is a cookie with this name.
   *
   * @param string $name
   * @return bool
   */
  static public function Exists($name) {
    return isset($_COOKIE[$name]);
  }

  /**
   * Returns true if there no cookie with this name or it's empty, or 0,
   * or a few other things. Check http://php.net/empty for a full list.
   *
   * @param string $name
   * @return bool
   */
  static public function IsEmpty($name) {
    return empty($_COOKIE[$name]);
  }

  /**
   * Get the value of the given cookie. If the cookie does not exist the value
   * of $default will be returned.
   *
   * @param string $name
   * @param string $default
   * @return mixed
   */
  static public function Get($name, $default = '') {
    return (isset($_COOKIE[$name]) ? $_COOKIE[$name] : $default);
  }

  /**
   * Set a cookie. Silently does nothing if headers have already been sent.
   *
   * @param string $name
   * @param string $value
   * @param mixed $expiry
   * @param string $path
   * @param string $domain
   * @return bool
   */
  static public function Set($name, $value, $expiry = self::OneYear, $path = '/', $domain = false) {
    $retval = false;
    if (!headers_sent())
    {
      if ($domain === false)
        $domain = $_SERVER['HTTP_HOST'];

      if ($expiry === -1)
        $expiry = 1893456000; // Lifetime = 2030-01-01 00:00:00
      elseif (is_numeric($expiry))
        $expiry += time();
      else
        $expiry = strtotime($expiry);

      $retval = @setcookie($name, $value, $expiry, $path, $domain);
      if ($retval)
        $_COOKIE[$name] = $value;
    }
            print_r($_COOKIE);
    return $retval;
  }

  /**
   * Delete a cookie.
   *
   * @param string $name
   * @param string $path
   * @param string $domain
   * @param bool $remove_from_global Set to true to remove this cookie from this request.
   * @return bool
   */
  static public function Delete($name, $path = '/', $domain = false, $remove_from_global = false) {
    $retval = false;
    if (!headers_sent()) {
      if ($domain === false)
        $domain = $_SERVER['HTTP_HOST'];
      $retval = setcookie($name, '', time() - 3600, $path, $domain);

      if ($remove_from_global)
        unset($_COOKIE[$name]);
    }
    return $retval;
  }
}

?>