<?php

return [
    /**
     * Taken from your apps SSO configuration screen, the field called "Issuer URL"
     */
    'issuer_url' => 'https://app.onelogin.com/saml/metadata/cfdf03b9-84f7-46ae-92f6-40313abd76ba',

    /**
     * Taken from your apps SSO configuration screen, the field called "SAML 2.0 Endpoint (HTTP)",
     * this is your "single sign on url"
     */
    'sso_url' => 'https://vinao.onelogin.com/trust/saml2/http-post/sso/cfdf03b9-84f7-46ae-92f6-40313abd76ba',

    /**
     * Taken from your apps SSO configuration screen, the field called "SLO Endpoint (HTTP)"
     */
    'slo_url' => 'https://vinao.onelogin.com/trust/saml2/http-redirect/slo/2262140',

    /**
     * Taken from your apps SSO configuration screen, to get this value, click on "View Details"
     * of the X.509 certificate on the SSO page.  Once you see the certificate, paste its value
     * (with or without newlines) inside the quoted value below. (This will be the textarea where
     * the contents start with -----BEGIN CERTIFICATE-----
     */
    'x509_cert' => 'MIID3DCCAsSgAwIBAgIUcFKxIcw2Yho/nb6pleXRInA3OkIwDQYJKoZIhvcNAQEF
    BQAwRTEQMA4GA1UECgwHU2ljcmVkaTEVMBMGA1UECwwMT25lTG9naW4gSWRQMRow
    GAYDVQQDDBFPbmVMb2dpbiBBY2NvdW50IDAeFw0yMzA2MTIxMzM4MjNaFw0yODA2
    MTIxMzM4MjNaMEUxEDAOBgNVBAoMB1NpY3JlZGkxFTATBgNVBAsMDE9uZUxvZ2lu
    IElkUDEaMBgGA1UEAwwRT25lTG9naW4gQWNjb3VudCAwggEiMA0GCSqGSIb3DQEB
    AQUAA4IBDwAwggEKAoIBAQC1kmNQsHnKmXHa9j1GG/ztqBfGvE2ZFDPdIYQtdm9B
    EKLi/EESpMCou2lQv9ym7gMslNe3SGsTPj34U06Dz5CeUlg1LdYdth0vs88Y1kAt
    wQchmJ+mvfQPtVHLzay0TDn1k6l/mmaaigAEXoGtbzqXDdEkharEUQ7D3IGiyxLh
    lxID2jZM6fuNWsYX08TIJ1Zb5dRudPFjmrBk6WQmUKL3L7ZSH5J4WJMlLjYyw8ub
    HCjSdzJp5p7+cP8zAJ4v6C0XKqHwbkzmPbk98HmkbD1rKFT54mdYptvoXB+R4td+
    n2TB+uq8rzLQOYzAECzFuZN9fZiRLNSC7tc7KP/xr76zAgMBAAGjgcMwgcAwDAYD
    VR0TAQH/BAIwADAdBgNVHQ4EFgQU8y4DCL4XE0AYBqB4eHSHeZrIK50wgYAGA1Ud
    IwR5MHeAFPMuAwi+FxNAGAageHh0h3mayCudoUmkRzBFMRAwDgYDVQQKDAdTaWNy
    ZWRpMRUwEwYDVQQLDAxPbmVMb2dpbiBJZFAxGjAYBgNVBAMMEU9uZUxvZ2luIEFj
    Y291bnQgghRwUrEhzDZiGj+dvqmV5dEicDc6QjAOBgNVHQ8BAf8EBAMCB4AwDQYJ
    KoZIhvcNAQEFBQADggEBAE3qmlV3udJ/NMgA1NMj5NAVnUPeYg823y4tytJCkx6S
    VE8sqbawx8jK9VcRiuma5Kisz0r6ufjpXGDV9OfA8jHvt2P8ANmISJN0Od4Jqp5k
    U+jeNhUfvdnYDY1IuwNOIhXr4sEmEAY+LJ95G6IzvFDiyx/llNm7qGGH0egh/4x5
    0z3YmECuNOe8fk9d/Q3JHmAvFu3xlo4cyXegaslraNfhvK+qwwcA2opi2gXwem5L
    qrfqE0NH2nqyNMDECv0A6HnVAcjOvWvHS129CWZgqZPgvamJfizpm2nRNn/j/IuE
    rT6YOC3oovxKpwBZQEFah8ZHDWZ0vkTdMktmP5X6/BI=',

    /**
     * These values affect how the appliaction behaves with regards to setting up urls and redirecting
     */
    'routing' => [

        /**
         * By default, use the 'web' middleware for the onelogin.* route group, as well as the
         * root routes /login and /logout if they are enabled
         */
        'middleware' => 'web',

        /**
         * The domain to attach just the onelogin.* routes to
         */
        'domain' => null,

        /**
         * The url that will be used when no "redirect back"/"previous" url can be determined in
         * a workflow
         */
        'fallback_redirect' => '/',

        /**
         * This plugin can provide /login and /logout routes to your application if they are enabled (which
         * they are by default).  Do this instead of using `artisan make:auth`
         */
        'root_routes' => [

            /**
             * enable?
             */
            'enable' => true,

            /**
             * Autologin (with enabled root routes) will not present a login button on the /login screen,
             * instead it will automatically redirect to the onelogin.login route. The actual behavior here
             * is that when a ->middleware('auth') route is hit by an unauthenticated user, the Error/Exception
             * handler will attempt to redirect to /auth, which the laravel-onelogin package can now handle for you.
             */
            'autologin' => false,
        ],

        /**
         * In certain circumstances (such as using cloudflare edge auth), the initial ACS POST request is
         * inadvertantly turned into a GET request to the ACS route. Enabling this will make sure that GET
         * requests are also redirected back to the onelogin SAML flow
         */
        'enable_acs_redirect_for_get' => false,
    ],

    /**
     * By default, the onelogin package will use the auth.defaults.guard as the guard to setup the user.
     * For applications with multiple guards (admin users vs. site users), configure this to use the guard
     * for the set of users you with to authenticate against one login.
     *
     * Note: the guard's provider must have a auth.providers.{provider}.model option
     */
    'guard' => null,

    'local_user' => [
        'enable' => false,

        'attributes' => [
            'email' => 'developer@example.com',
            'name' => 'Software Developer'
        ]
    ]
];
