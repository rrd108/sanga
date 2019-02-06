<?php
return [
	'Google' => [   //https://console.developers.google.com/apis/credentials?project=sanga-project-api-id&hl=hu
        'clientId' => '360395039036-a627mtlc8euo2o2bbfnleg5ks23adoac.apps.googleusercontent.com',
        'clientSecret' => 'e0jUWMUta5xVCKtyvdne170X',
        'redirectUri' => 'https://sanga.1108.cc/Contacts/google',

        'apiKey' => 'AIzaSyDm3pSeWA9jjT-91L-k9TylOmKkcku6QqQ'		//for geo shell
        ],

    'SendGrid' => [
        'apiKey' => 'SendGridAPI-key'
        ],

    'Mailjet' => [
        'apiKey' => 'MailjetAPI-key',
        'secretKey' => 'MailjetSecretKey'
        ],

    'ElasticEmail' => [
        'userName' => 'ElasticEmailUserName',
        'apiKey' => 'ElasticEmailAPI-key'
        ]
	];
