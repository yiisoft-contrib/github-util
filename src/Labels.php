<?php


namespace yiisoft;


use Github\Exception\MissingArgumentException;

class Labels extends \Github\Api\Repository\Labels
{
    private const HEADERS = [
        'Accept' => 'application/vnd.github.symmetra-preview+json',
    ];

    public function all($username, $repository)
    {
        return $this->get('/repos/' . rawurlencode($username) . '/' . rawurlencode($repository) . '/labels', self::HEADERS);
    }

    public function show($username, $repository, $label)
    {
        return $this->get('/repos/' . rawurlencode($username) . '/' . rawurlencode($repository) . '/labels/' . rawurlencode($label));
    }

    public function create($username, $repository, array $params)
    {
        if (!isset($params['name'], $params['color'])) {
            throw new MissingArgumentException(['name', 'color']);
        }

        return $this->post('/repos/' . rawurlencode($username) . '/' . rawurlencode($repository) . '/labels', $params, self::HEADERS);
    }

    public function update($username, $repository, $label, array $params)
    {
        if (!isset($params['name'], $params['color'])) {
            throw new MissingArgumentException(['name', 'color']);
        }

        return $this->patch('/repos/' . rawurlencode($username) . '/' . rawurlencode($repository) . '/labels/' . rawurlencode($label), $params, self::HEADERS);
    }

    public function remove($username, $repository, $label)
    {
        return $this->delete('/repos/' . rawurlencode($username) . '/' . rawurlencode($repository) . '/labels/' . rawurlencode($label), self::HEADERS);
    }
}