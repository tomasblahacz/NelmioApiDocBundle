<?php

/*
 * This file is part of the ApiDocBundle package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Bundle\ApiDocBundle\Describer;

use gossi\swagger\Swagger;

class SwaggerPhpDescriber implements DescriberInterface
{
    private $projectPath;
    private $overwrite;

    /**
     * @param string $projectPath
     */
    public function __construct(string $projectPath, bool $overwrite = false)
    {
        $this->projectPath = $projectPath;
        $this->overwrite = $overwrite;
    }

    public function describe(Swagger $api)
    {
        $annotation = \Swagger\scan($this->projectPath);

        $api->merge($this->normalize($annotation), $this->overwrite);
    }

    private function normalize($annotation)
    {
        return json_decode(json_encode($annotation));
    }
}