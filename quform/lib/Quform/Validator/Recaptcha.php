<?php

/**
 * Quform_Validator_Recaptcha
 *
 * Checks the given reCAPTCHA solution is correct
 *
 * @package Quform
 * @subpackage Validator
 * @copyright Copyright (c) 2009-2013 ThemeCatcher (http://www.themecatcher.net)
 */
class Quform_Validator_Recaptcha extends Quform_Validator_Abstract
{
    /**
     * reCAPTCHA private key
     * @var string
     */
    protected $_privateKey;

    /**
     * Error message templates
     * @var array
     */
    protected $_messageTemplates = array(
        'invalid-site-private-key' => 'Invalid reCAPTCHA private key',
        'invalid-request-cookie' => 'The challenge parameter of the verify script was incorrect',
        'incorrect-captcha-sol' => 'The CAPTCHA solution was incorrect',
        'recaptcha-not-reachable' => 'reCAPTCHA server not reachable'
    );

    /**
     * Constructor
     *
     * @param array $options
     */
    public function __construct($options = null)
    {
        parent::__construct($options);

        if (is_array($options)) {
            if (array_key_exists('privateKey', $options)) {
                $this->_privateKey = $options['privateKey'];
            }
        }
    }

    /**
     * Checks the reCAPTCHA answer
     *
     * @param $value The value to check
     * @return boolean True if valid false otherwise
     */
    public function isValid($value)
    {
        if ($this->_privateKey == null) {
            throw new Exception('reCAPTCHA private key is required');
        }

        $resp = recaptcha_check_answer($this->_privateKey, $_SERVER['REMOTE_ADDR'], $_POST['recaptcha_challenge_field'], $_POST['recaptcha_response_field']);

        if (!$resp->is_valid) {
            if (array_key_exists($resp->error, $this->_messageTemplates)) {
                $message = $this->_messageTemplates[$resp->error];
            } else {
                $message = $this->_messageTemplates['incorrect-captcha-sol'];
            }
            $this->addMessage($message);
            return false;
        }

        return true;
    }
}