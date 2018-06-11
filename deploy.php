<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'racing');

set('ssh_multiplexing', false);

// set stage
set('default_stage', 'staging');

// Project repository
set('repository', 'https://github.com/bredsjomagnus/racing.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts

// host('206.81.18.153')
// 	->user('magnus')
//     ->port(22)
//     ->set('deploy_path', '~/vhosts/race')
// 	->stage('staging');

// inventory('hosts.yml');

host('206.81.18.153')
	->user('magnus')
    ->port(22)
    ->configFile('~/.ssh/config')
    ->identityFile('~/.ssh/id_rsa')
    ->forwardAgent(true)
    ->multiplexing(true)
    ->addSshOption('UserKnownHostsFile', '/dev/null')
    ->addSshOption('StrictHostKeyChecking', 'no')
    ->stage('staging')
    ->roles('app')
    ->set('deploy_path', '~/vhosts/race');

// Tasks

// task('build', function () {
//     run('cd {{release_path}} && build');
// });

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');
