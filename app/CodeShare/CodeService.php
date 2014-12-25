<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 12/20/14
 * Time: 10:21 PM
 */

namespace CodeShare;


use AlfredNutileInc\Fixturizer\FixturizerReader;
use AlfredNutileInc\Fixturizer\FixturizerWriter;
use Code;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class CodeService {

    private $code;
    private $client;

    public function getAllGists()
    {
        $this->code = Code::all();

        $this->getGists();

        return $this->code;
    }

    public function post($store)
    {
        $code = new Code();
        $code->title = $store['title'];
        $code->gist_id = $this->createGist($store);
        $code->user_id = Auth::user()->id;
        $code->save();

        return $code;
    }

    public function createGist($store)
    {
        $params = [
            'description' => $store['title'],
            'public'      => 1,
            'files'       => [
                "{$store['name']}" => [
                    'content' => "{$store['code']}"
                ]
            ]
        ];
        $results = $this->getClient()->api('gists')->create($params);

        return $results['id'];
    }

    public function updateGist($id, $store)
    {
        $code = Code::findOrFail($id);
        $params = [
            'description' => $store['title'],
            'public'      => 1,
            'files'       => [
                "{$store['name']}" => [
                    'content' => "{$store['code']}"
                ]
            ]
        ];
        $results = $this->getClient()->api('gists')->update($code->gist_id, $params);

        return $results['id'];
    }

    public function getGists()
    {
        foreach($this->code as $key => $code)
        {
            $this->code[$key]->code = $this->getGist($code->gist_id);
        }
    }

    public function getGist($gist_id)
    {
        if(file_exists(base_path() . 'app/tests/fixtures/' . $gist_id))
        {
            $results = FixturizerReader::getFixture($gist_id);
        } else {
            $results = $this->getClient()->api('gists')->show($gist_id);
            FixturizerWriter::createFixture($results, $gist_id);
        }
        $file = $this->pluckFile($results);
        return $file;
    }

    public function pluckFile($results)
    {
        $files = $results['files'];
        return array_shift($files);
    }

    public function getClient()
    {
        if($this->client == null)
        {
            $this->setClient();
        }
        return $this->client;
    }

    public function setClient($client = null)
    {
        if($client == null)
        {
            $client = App::make('CodeShare\GitProviderInterface');
        }

        $this->client = $client;
        return $this;
    }
} 