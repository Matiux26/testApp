<?php

namespace App\Items;

use App\Items\DTO\ItemDTO;
use App\Items\Mapper\ItemMapper;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ItemsApiConsumer implements ItemsApiConsumerInterface
{

    private $client;
    private $apiUrl;
    const METHOD = 'api/items';

    public function __construct(HttpClientInterface $client, string $apiUrl)
    {
        $this->client = $client;
        $this->apiUrl = $apiUrl;
    }

    public function getItem(int $itemId) : ItemDTO
    {
        $response = $this->client->request(
            'GET',
            $this->apiUrl . self::METHOD . $itemId
        );

        $this->checkStatusCode($response->getStatusCode());

        return ItemMapper::map($response->toArray());
    }

    public function getItems() : array
    {
        $response = $this->client->request(
            'GET',
            $this->apiUrl . self::METHOD . '?page=1',
            [
                'headers' => [
                    'Accept' => 'application/json',
                ]
            ]
        );

        $this->checkStatusCode($response->getStatusCode());

        foreach($response->toArray() as $itemArray) {
            $items[] = ItemMapper::map($itemArray);
        }

        return $items;
    }

    public function deleteItem(int $itemId) : void
    {
        $response = $this->client->request(
            'DELETE',
            $this->apiUrl . self::METHOD . $itemId
        );

        $this->checkStatusCode($response->getStatusCode());
    }

    public function addItem(ItemDTO $itemDTO) : void
    {
        $response = $this->client->request(
            'POST',
            $this->apiUrl . self::METHOD
        );

        $this->checkStatusCode($response->getStatusCode());
    }

    private function checkStatusCode($statusCode) : void
    {
        if($statusCode != 200) {
            throw new HttpException($statusCode);
        }
    }
}
