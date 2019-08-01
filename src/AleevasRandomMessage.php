<?php

namespace Drupal\aleevas_experiments;

use Drupal\Core\Messenger\MessengerInterface;
use Drupal\aleevas_experiments\AleevasRandomMessageGenerator;

/**
 * AleevasRandomMessage service.
 */
class AleevasRandomMessage {

  /**
   * The aleevas_experiments.random_message_generator service.
   *
   * @var \Drupal\aleevas_experiments\AleevasRandomMessageGenerator
   */
  protected $aleevasRandomMessageGenerator;

  /**
   * The messenger.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * @var array
   */
  private $messageTypes;

  /**
   * Constructs an AleevasRandomMessage object.
   *
   * @param \Drupal\aleevas_experiments\AleevasRandomMessageGenerator $aleevas_experiments_random_message_generator
   *   The aleevas_experiments.random_message service.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger.
   * @param array $message_types
   *   The array of message type.
   */
  public function __construct(AleevasRandomMessageGenerator $aleevas_experiments_random_message_generator, MessengerInterface $messenger, array $message_types) {
    $this->aleevasRandomMessageGenerator = $aleevas_experiments_random_message_generator;
    $this->messageTypes = $message_types;
    $this->messenger = $messenger;
  }

  /**
   * Set message.
   */
  public function setRandomMessage() {
    $random_message = $this->aleevasRandomMessageGenerator->getRandomMessage();
    $random_message_type = rand(0, count($this->message_types) - 1);
    $this->messenger->addMessage($random_message, $this->message_types[$random_message_type]);
  }

}
