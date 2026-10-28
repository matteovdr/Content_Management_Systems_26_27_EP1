<?php

namespace Drupal\gamestore_wishlist\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Datetime\DateFormatterInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Admin-overzicht van alle wishlist-items.
 */
class WishlistAdminController extends ControllerBase {

  protected Connection $database;
  protected DateFormatterInterface $dateFormatter;

  public function __construct(Connection $database, DateFormatterInterface $date_formatter) {
    $this->database = $database;
    $this->dateFormatter = $date_formatter;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
      $container->get('date.formatter')
    );
  }

  public function overview() {
    // Alle wishlist-items, nieuwste eerst.
    $rows_db = $this->database->select('gamestore_wishlist', 'w')
      ->fields('w', ['uid', 'product_id', 'created'])
      ->orderBy('created', 'DESC')
      ->execute()
      ->fetchAll();

    $rows = [];
    $counts = [];
    foreach ($rows_db as $row) {
      $user = $this->entityTypeManager()->getStorage('user')->load($row->uid);
      $product = $this->entityTypeManager()->getStorage('commerce_product')->load($row->product_id);
      $title = $product ? $product->label() : $this->t('(verwijderd product)');
      $counts[$title] = ($counts[$title] ?? 0) + 1;
      $rows[] = [
        $user ? $user->getAccountName() : $this->t('(onbekend)'),
        $title,
        $this->dateFormatter->format($row->created, 'short'),
      ];
    }

    // Populairste producten.
    arsort($counts);
    $popular = [];
    foreach ($counts as $title => $count) {
      $popular[] = [$title, $count];
    }

    return [
      'popular_title' => ['#markup' => '<h2>' . $this->t('Populairste producten') . '</h2>'],
      'popular' => [
        '#type' => 'table',
        '#header' => [$this->t('Product'), $this->t('Aantal')],
        '#rows' => $popular,
        '#empty' => $this->t('Nog geen wishlist-items.'),
      ],
      'all_title' => ['#markup' => '<h2>' . $this->t('Alle items') . '</h2>'],
      'all' => [
        '#type' => 'table',
        '#header' => [$this->t('Gebruiker'), $this->t('Product'), $this->t('Toegevoegd')],
        '#rows' => $rows,
        '#empty' => $this->t('Nog geen wishlist-items.'),
      ],
      '#cache' => ['max-age' => 0],
    ];
  }

}
