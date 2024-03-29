<?php

namespace Drupal\aleevas_experiments;

/**
 * AleevasRandomMessageGenerator service.
 */
class AleevasRandomMessageGenerator {

  /**
   * @var array
   * An array of the messages.
   */
  private $messages = [];

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    $this->setMessages();
  }

  /**
   * Put values of messages into array.
   */
  private function setMessages() {
    $this->messages = [
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
      'Phasellus maximus tincidunt dolor et ultrices.',
      'Maecenas vitae nulla sed felis faucibus ultricies. Suspendisse potenti.',
      'In nec orci vitae neque rhoncus rhoncus eu vel erat.',
      'Donec suscipit consequat ex, at ultricies mi venenatis ut.',
      'Fusce nibh erat, aliquam non metus quis, mattis elementum nibh. Nullam volutpat ante non tortor laoreet blandit.',
      'Suspendisse et nunc id ligula interdum malesuada.',
    ];
  }

  /**
   * Return random message.
   */
  public function getRandomMessage() {
    $random = rand(0, count($this->messages) - 1);
    return $this->messages[$random];
  }

}
