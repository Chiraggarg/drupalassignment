<?php

namespace Drupal\ip_restrict\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a block with a functionality to restrict on basis of IP..
 *
 * @Block(
 *   id = "ip_restrict_block",
 *   admin_label = @Translation("IP restrict block"),
 * )
 */
class IPRestrictBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
	// Get the config value for this block.
    $config = $this->getConfiguration();
	// Get different values of block description, label and image path
	// to be passed to theme.
    $file = \Drupal\file\Entity\File::load($config['image'][0]);
    $uri = $file->getFileUri();
    $url = \Drupal\Core\Url::fromUri(file_create_url($uri))->toString();
    return [
        '#theme' => 'ip_restrict_block',
        '#image' => $url,
        '#title' => $config['label'],
        '#desc' => $config['block_desc'],
        '#cache' => array('max-age' => 0),
        '#attached' => array(
            'library' =>  array(      
            'ip_restrict/tile_structure'
            ),
        ),
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
	// Get the client IP address.
    $user_ip_address = \Drupal::request()->getClientIp();
    $config = $this->getConfiguration();
	// Get list of restricted IP address from the block form.
    $ip_address = explode(',', $config['ip_address']);
	// Compare the user IP with restricted IP to check if block is Allowed or Forbidden.
    if (in_array($user_ip_address, $ip_address)) {
        return AccessResult::forbidden();
    } else {
       return AccessResult::allowed(); 
    }
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
	// Adding block description, image and ip address fields to block form.
    $config = $this->getConfiguration();
    $form['image'] = [
        '#type' => 'managed_file',
        '#title' => t('Tile image'),
        '#upload_validators' => array(
            'file_validate_extensions' => array('gif png jpg jpeg'),
        ),
        '#upload_location' => 'public://',
        '#required' => TRUE,
        '#default_value' => isset($config['image']) ? $config['image'] : '',
    ];
    $form['ip_address'] = [
        '#type' => 'textarea',
        '#title' => t('Restrict IP address'),
        '#description' => 'Enter IP address separated by comma',
        '#default_value' => isset($config['ip_address']) ? $config['ip_address'] : '',
    ];
    $form['block_desc'] = [
        '#type' => 'textarea',
        '#title' => t('Block description'),
        '#description' => 'Enter block description',
        '#default_value' => isset($config['block_desc']) ? $config['block_desc'] : '',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
	// Save the values of these form values in config.
    $this->configuration['ip_address'] = $form_state->getValue('ip_address');
    $this->configuration['image'] = $form_state->getValue('image');
    $this->configuration['block_desc'] = $form_state->getValue('block_desc');
  }
}