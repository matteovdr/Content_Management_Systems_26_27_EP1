<?php

namespace Drupal\gamestore_wishlist\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Handles adding, removing and listing wishlist items.
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

  /**
   * Shows the wishlist of the current user.
   */
  public function list() {
    $uid = (int) $this->currentUser()->id();

    $items = $this->database->select('gamestore_wishlist', 'w')
      ->fields('w', ['product_id', 'created'])
      ->condition('uid', $uid)
      ->orderBy('created', 'DESC')
      ->execute()
      ->fetchAll();

    $storage = $this->entityTypeManager()->getStorage('commerce_product');
    $date_formatter = \Drupal::service('date.formatter');
    $rows = [];

    foreach ($items as $item) {
      $product = $storage->load($item->product_id);
      if (!$product) {
        continue;
      }
      $remove_url = Url::fromRoute('gamestore_wishlist.toggle', ['product_id' => $product->id()], [
        'query' => ['destination' => '/wishlist'],
      ]);
      $rows[] = [
        ['data' => $product->toLink()->toRenderable()],
        $date_formatter->format($item->created, 'short'),
        ['data' => Link::fromTextAndUrl($this->t('Remove'), $remove_url)->toRenderable()],
      ];
    }

    if (empty($rows)) {
      return [
        '#markup' => '<p>' . $this->t('Your wishlist is empty. Browse our <a href=":url">products</a>.', [
          ':url' => Url::fromUserInput('/producten')->toString(),
        ]) . '</p>',
        '#cache' => ['max-age' => 0],
      ];
    }

    return [
      '#type' => 'table',
      '#header' => [$this->t('Product'), $this->t('Added on'), $this->t('Actions')],
      '#rows' => $rows,
      '#cache' => ['max-age' => 0],
    ];
  }

}
