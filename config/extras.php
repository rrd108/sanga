<?php
return [
	'Google' => [   //https://console.developers.google.com/apis/credentials?project=sanga-project-api-id&hl=hu
        'clientId' => '360395039036-8955btktvmjl04jsogp8dcutmuetdt87.apps.googleusercontent.com',
        'clientSecret' => 'ULdCp4UZe5jDGUgfmWSbUS2Q',
        'redirectUri' => 'https://sanga.1108.cc/Contacts/google',

        'apiKey' => 'AIzaSyAT2IR6v7LAEastGHBtdUEKke2dKLz2EAk'		//for geo shell
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
