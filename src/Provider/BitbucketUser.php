<?php

namespace FlyingFlip\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class BitbucketUser implements ResourceOwnerInterface {
  /**
   * @var array
   */
  protected $userInfo = [];

  /**
   * @param GuzzleHttp\Psr7\Response $response
   */
  public function __construct(\GuzzleHttp\Psr7\Response $response) {
    $response = json_decode($response->getBody()->getContents());
    $this->userInfo = (array) $response;
  }

  public function getId() : string {
    return $this->userInfo['uuid'];
  }

  public function getAvatar() : string {
    return $this->userInfo['links']['avatar'];
  }

  /**
   * Get the display name.
   *
   * @return string
   */
  public function getDisplayName() : string {
    return $this->userInfo['display_name'];
  }

  /**
   * Get user data as an array.
   *
   * @return array
   */
  public function toArray() : array {
    return $this->userInfo;
  }
}
