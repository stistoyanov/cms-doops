<?php

namespace App\Jobs;

use App\Helpers\Copy;
use App\Helpers\Currency;
use App\Helpers\Language;
use App\Helpers\Timezone;
use App\Helpers\DataMapper;

use App\Product;

use Cz\Git\GitRepository;

use Log;
use Exception;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateMagentoProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $productId;

    /**
     * Create a new job instance.
     *
     * CreateMagentoProductJob constructor.
     * @param $productId
     */
    public function __construct($productId)
    {
        $this->productId = $productId;
    }

    /**
     * Execute the job.
     *
     * @throws Exception
     */
    public function handle()
    {
        $product = Product::find($this->productId);
        if (!$product) {
            throw new Exception('Product: ' . $this->productId . ' not found!');
        }

        try {

            $branch = $product->data['request'][DataMapper::BRANCH_NAME_IDENTIFIER];

            $dir = env('MAGENTO_2_DIR');

            $image = base_path() . '/../' . $dir;
            $repoPath = base_path() . '/../../' . $dir;

            $repo = new GitRepository($repoPath);
            $repo->fetch('origin', ['master']);
            $repo->checkout('master');
            $repo->pull('origin');
            $repo->createBranch($branch, true);

            Copy::all($image, $repoPath);
            self::buildEnv($product, $repoPath . '/env');

            $repo->addAllChanges();
            $repo->commit('Built ' . $product->name . ' application.');
            $repo->push('origin', [$branch , '-u']);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param Product $product
     * @param $path
     */
    public static function buildEnv(Product $product, $path)
    {
        file_put_contents($path, '');

        $content = '';
        foreach ($product->data['request'] as $key => $value) {
            if (in_array($key, array_values(DataMapper::$magentoEnvSettings))) {
                $content .= $key;
                if (in_array($key, DataMapper::$magentoEnvStrings)) {
                    $content .= '="' . $value . '"';
                } else if (in_array($key, DataMapper::$magentoEnvIntegers)) {
                    $content .= '=' . $value;
                } else if ($key == DataMapper::MAGENTO_LANGUAGE) {
                    $content .= '="' . Language::get($value)['key'] . '"';
                } else if ($key == DataMapper::MAGENTO_TIMEZONE) {
                    $content .= '="' . Timezone::get($value)['key'] . '"';
                } else if ($key == DataMapper::MAGENTO_DEFAULT_CURRENCY) {
                    $content .= '="' . Currency::get($value)['key'] . '"';
                }
                $content .= PHP_EOL;
            }
        }

        file_put_contents($path, $content);
    }

    /**
     * @param Exception $exception
     */
    public function failed(Exception $exception)
    {
        Log::error(__CLASS__ . ' failed with message - ' . $exception->getMessage());
    }
}
