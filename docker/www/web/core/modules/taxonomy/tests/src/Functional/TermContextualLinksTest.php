<?php

declare(strict_types=1);

namespace Drupal\Tests\taxonomy\Functional;

/**
 * Tests views contextual links on terms.
 *
 * @group taxonomy
 */
class TermContextualLinksTest extends TaxonomyTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'contextual',
  ];

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * Tests contextual links.
   */
  public function testTermContextualLinks(): void {
    $vocabulary = $this->createVocabulary();
    $term = $this->createTerm($vocabulary);

    $user = $this->drupalCreateUser([
      'access content',
      'access contextual links',
    ]);
    $this->drupalLogin($user);

    $this->drupalGet('taxonomy/term/' . $term->id());
    $this->assertSession()->elementExists('css', 'div[data-contextual-id^="taxonomy_term:taxonomy_term=' . $term->id() . ':"]');
  }

}
