<?php return array(
    'root' => array(
        'name' => 'admin/project',
        'pretty_version' => '1.0.0+no-version-set',
        'version' => '1.0.0.0',
        'reference' => null,
        'type' => 'n',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        'admin/project' => array(
            'pretty_version' => '1.0.0+no-version-set',
            'version' => '1.0.0.0',
            'reference' => null,
            'type' => 'n',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'stripe/stripe-php' => array(
            'pretty_version' => 'v15.5.0',
            'version' => '15.5.0.0',
            'reference' => 'd20fbbf2557773106c0ec2198b1b16b40f5081bc',
            'type' => 'library',
            'install_path' => __DIR__ . '/../stripe/stripe-php',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
    ),
);
