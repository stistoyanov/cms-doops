<?php

namespace App\Http\Controllers;

use App\Helpers\Currency;
use App\Helpers\DataMapper;
use App\Helpers\Language;
use App\Helpers\Timezone;
use App\Jobs\CreateMagentoProductJob;
use App\Product;
use App\User;
use Cz\Git\GitRepository;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class TmpController extends Controller
{
    public function index()
    {
        dd('THIS IS A TESTING ROUTE');

        $repoName = 'test1';
        $path = base_path() . '/../../' . $repoName;
        try {
            $repo = new GitRepository($path);

            $branches = $repo->getBranches();

            dd($branches);

//            $repo->push('remote-name', array('--options'));
//            $repo->push('origin');
//            $repo->push('origin', array('master', '-u'));

//            $repo->addRemote('test2', 'git@github.com:stistoyanov/test1.git', ['--options']);
//            $repo->addRemote('origin', 'git@github.com:stistoyanov/test2.git');

//            // create a new file in repo
//            $filename = $repo->getRepositoryPath() . '/readme.txt';
//            file_put_contents($filename, "Lorem ipsum
//                dolor
//                sit amet
//            ");
//
//            // commit
//            $repo->addFile($filename);
//            $repo->commit('init commit');


        } catch (\Exception $e) {
            dd($e->getMessage());
        }


        dd('THIS IS A TESTING ROUTE');
    }
}