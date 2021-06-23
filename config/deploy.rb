# config valid for current version and patch releases of Capistrano
lock "3.15.0"

set :application, "thabarwa-website"
set :repo_url, "git@github.com:shanjue/Thabarwa_Kutholshin.git"

# Default branch is :master
# ask :branch, `git rev-parse --abbrev-ref HEAD`.chomp

# Default value for :format is :airbrussh.
# set :format, :airbrussh

# You can configure the Airbrussh format using :format_options.
# These are the defaults.
# set :format_options, command_output: true, log_file: "log/capistrano.log", color: :auto, truncate: :auto

# Default value for :pty is false
# set :pty, true

# Default value for :linked_files is []
# append :linked_files, "config/database.yml"

# Default value for linked_dirs is []
# append :linked_dirs, "log", "tmp/pids", "tmp/cache", "tmp/sockets", "public/system"

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for local_user is ENV['USER']
# set :local_user, -> { `git config user.name`.chomp }

# Default value for keep_releases is 5
set :keep_releases, 2

# Uncomment the following to require manually verifying the host key before first deploy.
# set :ssh_options, verify_host_key: :secure
# Which roles to consider as laravel roles
# Which roles to consider as laravel roles
set :laravel_roles, :all

# The artisan flags to include on artisan commands by default
set :laravel_artisan_flags, "--env=#{fetch(:stage)}"

# Which roles to use for running migrations
set :laravel_migration_roles, :all

# The artisan flags to include on artisan commands by default when running migrations
set :laravel_migration_artisan_flags, "--force --env=#{fetch(:stage)}"

# The version of laravel being deployed
set :laravel_version, 7.30

# Whether to upload the dotenv file on deploy
set :laravel_upload_dotenv_file_on_deploy, true

# The user that the server is running under (used for ACLs)
# set :laravel_server_user, 'binarylab'

# Ensure the dirs in :linked_dirs exist?
set :laravel_ensure_linked_dirs_exist, true

# Link the directores in laravel_linked_dirs?
set :laravel_set_linked_dirs, true


# Linked directories for a standard Laravel 5 application
set :laravel_5_linked_dirs, [
 'storage'
]

# Ensure the paths in :file_permissions_paths exist?
set :laravel_ensure_acl_paths_exist, true

# Set ACLs for the paths in laravel_acl_paths?
set :laravel_set_acl_paths, true


# Paths that should have ACLs set for a standard Laravel 5 application
set :laravel_5_acl_paths, [
 'bootstrap/cache',
 'storage',
 'storage/app',
 'storage/app/public',
 'storage/framework',
 'storage/framework/cache',
 'storage/framework/sessions',
 'storage/framework/views',
 'storage/logs',
 'public'
]

namespace :npm do
    desc "Running Npm Install"
    task :install do
        on roles(:all) do
            execute "cd #{fetch(:release_path)} && npm install"
        end
    end
end

namespace :composer do
    desc "Running Composer Install"
    task :install do
        on roles(:all) do
            execute "cd #{fetch(:release_path)} && composer install --prefer-dist --optimize-autoloader"
        end
    end
end

namespace :deploy do
    after :finishing, 'laravel:migrate'
    after :finishing, 'composer:install'
    after :finishing, 'npm:install'
    after :finishing, 'php_fpm:restart'
    after :rollback, 'php_fpm:restart'
end
