<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Cz\Git\GitRepository;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class TmpController extends Controller
{
    public function index()
    {
        $selected = '';
        $OptionsArray = timezone_identifiers_list();
        dd($OptionsArray);
        $select= '<select name="SelectContacts">';
        while (list ($key, $row) = each ($OptionsArray) ){
            $select .='<option value="'.$key.'"';
            $select .= ($key == $selected ? ' selected' : '');
            $select .= '>'.$row.'</option>';
        }  // endwhile;
        $select.='</select>';
        dd($select);


        $test = Product::getTypeIndex(Product::TYPE_MAGENTO_2);
        dd($test);

        dd('rr');

        $repoName = 'test1';
        $repoPath = base_path() . '/../../' . $repoName;

        $branch = 'test-5';

        try {
            $repo = new GitRepository($repoPath);
            $repo->fetch('origin', ['master']);
            $repo->checkout('master');
            $repo->pull('origin');
            $repo->createBranch($branch, true);
            $repo->push('origin', [$branch , '-u']);

//            $repo->addRemote($branch, 'git@github.com:stistoyanov/test1.git');
//            $repo->push('origin', array('master', '-u'));
//            $repo->push('origin', ['test-2', '-u']);


//            $repo->addRemote('new', 'git@github.com:stistoyanov/test2.git');
//            $repo->addRemote('origin', 'git@github.com:stistoyanov/test1.git');

//            dd($repo->getBranches());
//            $repo->addRemote('origin', 'git@github.com:stistoyanov/test2.git');

//            $repo->createBranch('dev-1', true);
//            $repo->commit('Hello there');

        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        dd($repo->getRepositoryPath());
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