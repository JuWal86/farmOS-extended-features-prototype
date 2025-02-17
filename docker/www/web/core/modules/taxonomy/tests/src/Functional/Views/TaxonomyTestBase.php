<?php

declare(strict_types=1);

namespace Drupal\Tests\taxonomy\Functional\Views;

use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\Tests\field\Traits\EntityReferenceFieldCreationTrait;
use Drupal\Tests\views\Functional\ViewTestBase;
use Drupal\taxonomy\Entity\Vocabulary;
use Drupal\taxonomy\Entity\Term;
use Drupal\views\Tests\ViewTestData;

/**
 * Base class for all taxonomy tests.
 */
abstract class TaxonomyTestBase extends ViewTestBase {

  use EntityReferenceFieldCreationTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['taxonomy', 'taxonomy_test_views', 'node'];

  /**
   * Stores the nodes used for the different tests.
   *
   * @var \Drupal\node\NodeInterface[]
   */
  protected $nodes = [];

  /**
   * The vocabulary used for creating terms.
   *
   * @var \Drupal\taxonomy\VocabularyInterface
   */
  protected $vocabulary;

  /**
   * Stores the first term used in the different tests.
   *
   * @var \Drupal\taxonomy\TermInterface
   */
  protected $term1;

  /**
   * Stores the second term used in the different tests.
   *
   * @var \Drupal\taxonomy\TermInterface
   */
  protected $term2;

  /**
   * {@inheritdoc}
   */
  protected function setUp($import_test_views = TRUE, $modules = []): void {
    // Important: taxonomy_test_views module must not be in the $modules to
    // avoid an issue that particular view is already exists.
    parent::setUp($import_test_views, $modules);
    $this->mockStandardInstall();

    // This needs to be done again after ::mockStandardInstall() to make
    // test vocabularies available.
    // Explicitly add taxonomy_test_views to $modules now, so required views are
    // being created.
    $modules[] = 'taxonomy_test_views';
    if ($import_test_views) {
      ViewTestData::createTestViews(static::class, $modules);
    }

    $this->term1 = $this->createTerm();
    $this->term2 = $this->createTerm();

    $node = [];
    $node['type'] = 'article';
    $node['field_views_testing_tags'][]['target_id'] = $this->term1->id();
    $node['field_views_testing_tags'][]['target_id'] = $this->term2->id();
    $this->nodes[] = $this->drupalCreateNode($node);
    $this->nodes[] = $this->drupalCreateNode($node);
  }

  /**
   * Provides a workaround for the inability to use the standard profile.
   *
   * @see https://www.drupal.org/node/1708692
   */
  protected function mockStandardInstall() {
    $this->drupalCreateContentType([
      'type' => 'article',
    ]);
    // Create the vocabulary for the tag field.
    $this->vocabulary = Vocabulary::create([
      'name' => 'Views testing tags',
      'vid' => 'views_testing_tags',
    ]);
    $this->vocabulary->save();
    $field_name = 'field_' . $this->vocabulary->id();

    $handler_settings = [
      'target_bundles' => [
        $this->vocabulary->id() => $this->vocabulary->id(),
      ],
      'auto_create' => TRUE,
    ];
    $this->createEntityReferenceField('node', 'article', $field_name, 'Tags', 'taxonomy_term', 'default', $handler_settings, FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED);

    /** @var \Drupal\Core\Entity\EntityDisplayRepositoryInterface $display_repository */
    $display_repository = \Drupal::service('entity_display.repository');
    $display_repository->getFormDisplay('node', 'article')
      ->setComponent($field_name, [
        'type' => 'entity_reference_autocomplete_tags',
        'weight' => -4,
      ])
      ->save();

    $display_repository->getViewDisplay('node', 'article')
      ->setComponent($field_name, [
        'type' => 'entity_reference_label',
        'weight' => 10,
      ])
      ->save();
    $display_repository->getViewDisplay('node', 'article', 'teaser')
      ->setComponent($field_name, [
        'type' => 'entity_reference_label',
        'weight' => 10,
      ])
      ->save();
  }

  /**
   * Creates and returns a taxonomy term.
   *
   * @param array $settings
   *   (optional) An array of values to override the following default
   *   properties of the term:
   *   - name: A random string.
   *   - description: A random string.
   *   - format: First available text format.
   *   - vid: Vocabulary ID of self::$vocabulary object.
   *   - langcode: LANGCODE_NOT_SPECIFIED.
   *   Defaults to an empty array.
   *
   * @return \Drupal\taxonomy\Entity\Term
   *   The created taxonomy term.
   */
  protected function createTerm(array $settings = []) {
    $filter_formats = filter_formats();
    $format = array_pop($filter_formats);
    $settings += [
      'name' => $this->randomMachineName(),
      'description' => $this->randomMachineName(),
      // Use the first available text format.
      'format' => $format->id(),
      'vid' => $this->vocabulary->id(),
      'langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED,
    ];
    $term = Term::create($settings);
    $term->save();
    return $term;
  }

}
