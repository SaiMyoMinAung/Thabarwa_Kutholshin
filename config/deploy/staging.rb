server '159.65.3.180', user: 'thabarwa', roles: %w{thabarwa}

set :ssh_options, {
   keys: %w(~/.ssh/id_rsa.pub),
   forward_agent: true
}

# Default deploy_to directory is /var/www/my_app_name
set :deploy_to, "/var/www/thabarwa-staging"

set :branch, 'staging'

# Which dotenv file to transfer to the server
set :laravel_dotenv_file, './.env.staging'

#fpm restart
set :php_fpm_with_sudo, true
set :php_fpm_roles, :app
set :php_fpm_service_name, 'php7.4-fpm' # Change this if you have non-standard naming for the php-fpm service
# set :systemctl_location, '/bin/systemctl'# server-based syntax
