<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'firebase' => [
        'database_url' => env('FIREBASE_DATABASE_URL', 'https://yagot-ad659.firebaseio.com'),
        'project_id' => env('FIREBASE_PROJECT_ID', 'yagot-ad659'),
        'private_key_id' => env('FIREBASE_PRIVATE_KEY_ID', '907cb1030605faaebc815e37d01f3e06ee29c197'),
        'private_key' => str_replace("\\n", "\n", env('FIREBASE_PRIVATE_KEY', '\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC4s4cKNn7+k9oJ\nBXiN3ktjFY4OR+eaX9z7Fsbh2Nutg8EjXriax8ud23PVtqPCK88OurNF8OSQh7I0\nD+EABo5ToVBTKk3XamYIEEmKql8iS1l67AYvDx/9sk94SyBF1ziPr49HcaFOUKV+\nG/2bXYKOsoieCejjTb8iwdAuzX3/BEJ6rV+RP5/9JBdfsu9/N+OomaPrTAY4i4kx\ntWNIbdQuiKt2U+ASleUvdvl5NqpxjXj5H2DdtR1q3s1A4NKnVxVP66skeLW+s8wk\nzxb5gW3jrrYTU4Eic7zPXHH7lkqpzI6v2ySrc2lLbxwdQzHb3JIAMLsR85//fDuK\n2WDbjvGLAgMBAAECggEAWJTJVA2U1HWGYUM9cRTGpQumaJT1r6UAL2/aDGDb4pjI\n3TTFZn4h2mBwanPAkBRAprjF1+pTRDnALpXa/A8o3VUFWA127bQ6oO1mx9kz7Rek\nH37o7FLdreeBk5i8LqKsnsS8+6+0hAHLjPLRq1yqi9N2EA2CotkbrQi01m15Wv8W\nYD9Ou58zVLwcz6RTeZOot1kqDb5bGJ0sRqQR5CwVWV/R+urcsEuwFZ66OPZbCIDV\noKdGfXER7dcwaxjeixfAdzqHlYKbPQ6oI0iwYkHViBlRLu9e5z3u4dplCpJ1aQzZ\nB18NCVCIRQKuQry7hEEYlmzPd47JiMA0X8SpRhWDWQKBgQD6GmXaItSdbz4P9UiD\n2MRG0yGJui1omyLfCM0hlLNl38daxTv+jDDsm7JmfNsEmqi/uEQbF443wRf2c599\n5Qp66sRiKqVuBrA0lnF//OAUKmUPa+1wddsILyJNT5ur8Tlfxv+Fw7hU8onnmmJJ\ncLirXXKig3GM/Byhd6HLS3I8ZwKBgQC9Dl6UUhUsC2gdGWXkGtT5NmCTqAnyBzEP\nlKb++DO2E3vemegAMF+003hXAoLCYUqZGgwXan5grvCHwxaOsYS7kbSoBHw/IPYB\nPmzv9hrANe3fcAR7uYxQ97EwWgvORC7rd/pljfQxww4t9ZtKwEgABNXpiq+k0UTD\nfeGn7nzrPQKBgHaM9sSMiA3MQjXcRbBBmuAbiiU3u/h+uOvRxzJowxTCG0Qag9Kn\n7zTopIrSGhs3mE+wb5AL/VzOSaaHrg1F+U7EY6xInLvnrbRvr4NEgY7tfZPuy9Dn\n/JgHh5Hv71F0eYa91Dc6y/BwOxAubPJ03QRVulXwSm3Sv1uGUooDzDV3AoGAJ3OU\nMQdf+6z1sPzX0l33C3pZdPaf/K2bg1DV+Gb7A4fVVYJwc3mkvytR9XZEqyN6WbCh\nzVEfxjU7ZFlFn8lTlYC2XklxVAsgyumn+fs1Yd7fIL1Tci4qJctKYnin9gcsc166\nFe8lgizeDKEwIs01OSvJJ88VECPLYbAnItAVqVECgYEAmoks4VeWkkX/x3T6iA3D\nPK5QdUXcfeKWHzTXRXwpeI92RwjL8ZYk6LYfFa70BUaZhdgv2CV36sr0uTQzgihl\nKHh2FQp0OgnCIjiIyeljEUx2T+HJ61AcIweZ0n8oHR+U0llDaAEQLiM4WuiOl6EM\nrI73UdET/h97+mRYGtprRGA=\n')),
        'client_email' => env('FIREBASE_CLIENT_EMAIL', 'firebase-adminsdk-zj2or@yagot-ad659.iam.gserviceaccount.com'),
        'client_id' => env('FIREBASE_CLIENT_ID', '109341139354638767695'),
        'client_x509_cert_url' => env('FIREBASE_CLIENT_x509_CERT_URL', 'https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-zj2or%40yagot-ad659.iam.gserviceaccount.com'),
    ]

];
