<?php

namespace Drupal\gamestore_wishlist\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Handles adding and removing wishlist items.
 */
class WishlistController extends ControllerBase {

  /**
   * The database connection.
   */
  protected Connection $database;

  public function __construct(Connection $database) {
    $this->database = $database;
  }

  public static function create(ContainerInterface $container) {
    return new static($container->get('database'));
  }

  /**
   * Adds a product to the wishlist, or removes it if it is already there.
   */
  public function toggle(int $product_id) {
    $uid = (int) $this->currentUser()->id();

    $product = $this->entityTypeManager()
      ->getStorage('commerce_product')
      ->load($product_id);

    if (!$product) {
      $this->messenger()->addError($this->t('That product does not exist.'));
      return new RedirectResponse(Url::fromUserInput('/producten')->toString());
    }

    $exists = $this->database->select('gamestore_wishlist', 'w')
      ->fields('w', ['id'])
      ->condition('uid', $uid)
      ->condition('product_id', $product_id)
      ->execute()
      ->fetchField();

    if ($exists) {
      $this->database->delete('gamestore_wishlist')
        ->condition('id', $exists)
        ->execute();
      $this->messenger()->addStatus($this->t('@title removed from your wishlist.', ['@title' => $product->label()]));
    }
    else {
      $this->database->insert('gamestore_wishlist')
        ->fields([
          'uid' => $uid,
          'product_id' => $product_id,
          'created' => \Drupal::time()->getRequestTime(),
        ])
        ->execute();
      $this->messenger()->addStatus($this->t('@title added to your wishlist.', ['@title' => $product->label()]));
    }

    return new RedirectResponse(Url::fromUserInput('/producten')->toString());
  }

}
