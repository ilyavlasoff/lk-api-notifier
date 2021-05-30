<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class QueryService
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var ParameterBagInterface
     */
    private $parameterBag;

    public function __construct(HttpClientInterface $client, ParameterBagInterface $parameterBag)
    {
        $this->httpClient = $client;
        $this->parameterBag = $parameterBag;
    }

    /**
     * @param string $group
     * @param string $discipline
     * @param string $semester
     * @return array
     * @throws \Exception
     */
    public function getChatMemberList(string $group, string $discipline, string $semester)
    {
        try {
            $response = $this->httpClient->request(
                'GET',
                "http://{$this->parameterBag->get('service_url_base')}/api/{$this->parameterBag->get('service_api_version')}/service/discussion/members/list",
                [
                    'query' => [
                        'g' => $group,
                        'dis' => $discipline,
                        'sem' => $semester
                    ]
                ]
            );

            if($response->getStatusCode() != Response::HTTP_OK) {
                throw new \Exception('Wrong data');
            }
        } catch (TransportExceptionInterface $e) {
            throw new \Exception('Service is unavailable');
        }

        try {
            $membersList = json_decode($response->getContent());
        } catch (ClientExceptionInterface | RedirectionExceptionInterface | ServerExceptionInterface | TransportExceptionInterface $e) {
            throw new \Exception('Unable to fetch service response');
        }

        $memberIdList = [];
        foreach ($membersList->payload as $memberData) {
            $memberIdList[] = $memberData->uoid;
        }

        return $memberIdList;
    }
}