<?php

/**
 * Copyright 2010 - 2019, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2018, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

use Cake\Routing\Router;

$config = [
    'Users' => [
        // Table used to manage users
        'table' => 'CakeDC/Users.Users',
        // Controller used to manage users plugin features & actions
        'controller' => 'CakeDC/Users.Users',
        // Password Hasher
        'passwordHasher' => '\Cake\Auth\DefaultPasswordHasher',
        'middlewareQueueLoader' => \CakeDC\Users\Loader\MiddlewareQueueLoader::class,
        // token expiration, 1 hour
        'Token' => ['expiration' => 3600],
        'Email' => [
            // determines if the user should include email
            'required' => true,
            // determines if registration workflow includes email validation
            'validate' => true,
        ],
        'Registration' => [
            // determines if the register is enabled
            'active' => false,
            // determines if the reCaptcha is enabled for registration
            'reCaptcha' => true,
            // allow a logged in user to access the registration form
            'allowLoggedIn' => false,
            //ensure user is active (confirmed email) to reset his password
            'ensureActive' => false,
            // default role name used in registration
            'defaultRole' => 'user',
        ],

        'Tos' => [
            // determines if the user should include tos accepted
            'required' => true,
        ],
        'Social' => [
            // enable social login
            'login' => false,
        ],

        'Key' => [
            'Session' => [
                // session key to store the social auth data
                'social' => 'Users.social',
                // userId key used in reset password workflow
                'resetPasswordUserId' => 'Users.resetPasswordUserId',
            ],
            // form key to store the social auth data
            'Form' => [
                'social' => 'social'
            ],
            'Data' => [
                // data key to store the users email
                'email' => 'email',
                // data key to store email coming from social networks
                'socialEmail' => 'info.email',
                // data key to check if the remember me option is enabled
                'rememberMe' => 'remember_me',
            ],
        ],
        // Avatar placeholder
        'RememberMe' => [
            // configure Remember Me component
            'active' => true,
            'checked' => true,
            'Cookie' => [
                'name' => 'remember_me',
                'Config' => [
                    'expires' => new \DateTime('+1 month'),
                    'httponly' => true,
                ]
            ]
        ],
        'Superuser' => ['allowedToChangePasswords' => true], // able to reset any users password
    ],
    'OneTimePasswordAuthenticator' => [
        'checker' => \CakeDC\Auth\Authentication\DefaultOneTimePasswordAuthenticationChecker::class,
        'login' => false,
        'issuer' => null,
        // The number of digits the resulting codes will be
        'digits' => 6,
        // The number of seconds a code will be valid
        'period' => 30,
        // The algorithm used
        'algorithm' => 'sha1',
        // QR-code provider (more on this later)
        'qrcodeprovider' => null,
        // Random Number Generator provider (more on this later)
        'rngprovider' => null
    ],
    'U2f' => [
        'enabled' => false,
        'checker' => \CakeDC\Auth\Authentication\DefaultU2fAuthenticationChecker::class,
    ],
    // default configuration used to auto-load the Auth Component, override to change the way Auth works
    'Auth' => [
        'Authentication' => [
            'serviceLoader' => \CakeDC\Users\Loader\AuthenticationServiceLoader::class
        ],
        'AuthenticationComponent' => [
            'load' => true,
            'loginRedirect' => '/',
            'requireIdentity' => false
        ],
        'Authenticators' => [
            'Token' => [
                'className' => 'Authentication.Token',
                'skipTwoFactorVerify' => true,
                'header' => null,
                'queryParam' => 'api_key',
                'tokenPrefix' => null,
            ]
        ],
        'Identifiers' => [
            /*
            'Password' => [
                'className' => 'Authentication.Password',
                'fields' => [
                    'username' => ['username', 'email'],
                    'password' => 'password'
                ],
                'resolver' => [
                    'className' => 'Authentication.Orm',
                    'finder' => 'active'
                ],
            ],
            */
            'Token' => [
                'className' => 'Authentication.Token',
                'tokenField' => 'api_token',
                'resolver' => [
                    'className' => 'Authentication.Orm',
                    'finder' => 'active'
                ],
            ]
        ],
        "Authorization" => [
            'enable' => true,
            'serviceLoader' => \CakeDC\Users\Loader\AuthorizationServiceLoader::class
        ],
        'AuthorizationMiddleware' => [
            'unauthorizedHandler' => [
                'className' => 'Authorization.Exception',//'CakeDC/Users.DefaultRedirect',
            ]
        ],
        'AuthorizationComponent' => [
            'enabled' => true,
        ],
        'RbacPolicy' => [],
        'PasswordRehash' => [
            'identifiers' => ['Password'],
        ]
    ],
];

return $config;
