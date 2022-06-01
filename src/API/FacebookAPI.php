<?php

namespace App\API;

use App\Entity\FacebookPost;
use App\Entity\OnadEtBeaute;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

/**
 * This class is use for connect facebook pai and get posts which are tag with #onadetbeaute
 */
class FacebookAPI
{
    private $manager;

    private $client;

    private $flash;

    private $router;

    private $token;

    public function __construct(EntityManagerInterface $manager, HttpClientInterface $client,
        FlashBagInterface $flash, RouterInterface $router
    ) {
        $this->manager = $manager;
        $this->client = $client;
        $this->flash = $flash;
        $this->router = $router;
    }

    /**
     * This function does the process for get all the access tokens (user and page) allowing to connect to facebook api
     *
     * @param string $code The code is the sended code by facebook api in the request uri (GET parameter)
     *
     * @return RedirectResponse
     */
    public function getAccessToken($code): RedirectResponse
    {
        // Get access token
        try {
            // Get id and token for connection at facebook API
            $onadetbeaute = $this->manager->getRepository(OnadEtBeaute::class)->findAll()[0];

            //Get an access token with url code
            $response = $this->client->request(
                'GET',
                'https://graph.facebook.com/v12.0/oauth/access_token?redirect_uri=' . 
                    $onadetbeaute->getFacebookRedirectUri() . '&state=987654321&client_id=' . 
                    $onadetbeaute->getFacebookClientId() . '&client_secret=' . 
                    $onadetbeaute->getFacebookClientSecret() . '&code=' . $code,
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ]
                ]
            );

            $accessToken = json_decode($response->getContent(), true)['access_token'];

        } catch (TransportExceptionInterface  $e) {

            $this->flash->add('danger', 'La connexion avec facebook n\' a pas fonctionné');
            return new RedirectResponse($this->router->generate('home'));
        }

        //Get access token long
        try {
            //Get an access token long life
            $response = $this->client->request(
                'GET',
                'https://graph.facebook.com/v12.0/oauth/access_token?grant_type=fb_exchange_token&client_id=' .
                $onadetbeaute->getFacebookClientId() . '&client_secret=' . 
                $onadetbeaute->getFacebookClientSecret() . '&fb_exchange_token=' . $accessToken,
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ]
                ]
            );

            $accessTokenLong = json_decode($response->getContent(), true)['access_token'];


        } catch (\Exception $e) {
            $this->flash->add('danger', 'La connexion avec facebook n\' a pas fonctionné');
            return new RedirectResponse($this->router->generate('home'));
        }

        //Get an access token for page onadetbeaute
        try {
            $response = $this->client->request(
                'GET',
                'https://graph.facebook.com/v12.0/' .
                $onadetbeaute->getFacebookUserId() . '/accounts?fields=name,access_token&
                    access_token='. $accessTokenLong,
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ]
                ]
            );
            $pageTokenLong = json_decode($response->getContent(), true)['data'][0]['access_token'];

            $onadetbeaute->setFacebookToken($pageTokenLong);
            $this->manager->persist($onadetbeaute);
            $this->manager->flush();
            
        } catch (\Exception $e) {
            $this->flash->add('danger', 'La connexion avec facebook n\' a pas fonctionné');
            return new RedirectResponse($this->router->generate('home'));
        }
    }

    /*/**
     * This function sorts posts for keep only posts those with a picture
     * @todo a changer en js pour filtrer les posts recus
     * @param [type] $posts
     * @return array
     */
    /*private function filterPosts($posts)
    {
        $postsSorted = [];

        foreach ($posts['data'] as $post) {

            $response = $this->client->request(
                'GET',
                'https://graph.facebook.com/v12.0/' . $post['id'] . '?fields=picture,message',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->token,
                    ]
                ]
            );
            //dump(json_decode($response->getContent(), true)['message']); 

            //Only posts contains '#onadetbeaute'in their message and has a picture are displayed on the website
            if (isset(json_decode($response->getContent(), true)['picture']) 
                && isset(json_decode($response->getContent(), true)['message'])
                //&& str_contains(json_decode($response->getContent(), true)['message'], '#onadetbeaute.com')
            ) {
                $facebookPost = new FacebookPost();
                $facebookPost->setPicture(json_decode($response->getContent(), true)['picture'])
                    ->setMessage(json_decode($response->getContent(), true)['message'])
                    ->setFacebookId($post['id']);

                $postsSorted[] = $facebookPost; 
            }
        }
        
        return $postsSorted;
    }*/
}