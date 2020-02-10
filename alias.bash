alias bashrc='nano ~/.bashrc'

alias composer-install='docker-compose run --rm web composer install'
alias composer-update='docker-compose run --rm web composer update'

alias doc-down='docker-compose down'
alias doc-img='docker images'
alias doc-img-a='docker images -a'
alias doc-logs='docker-compose logs'
alias doc-ps='docker ps'
alias doc-ps-a='docker ps -a'
alias doc-res='doc-stop && doc-up'
alias doc-start='docker-compose start'
alias doc-stop='docker-compose stop'
alias doc-up='docker-compose up -d'
alias doc-up-b='docker-compose up --build'
alias doc-up-bd='docker-compose up --build -d'
alias doc-web-exec='docker-compose exec web bash'

alias migrate-dev-a='vendor/bin/phinx migrate -e development'
alias rollback-dev='vendor/bin/phinx rollback -e development'
alias rollback-dev-a='vendor/bin/phinx rollback -e development -t 0'

alias test-up='docker-compose run --rm web vendor/bin/phpunit'
phpunit() {
  EXECUTE='./vendor/bin/phpunit'
  if [ -f './bin/phpunit' ]; then
      EXECUTE='./bin/phpunit'
  fi
  docker-compose run --rm web ${EXECUTE} "$@"
}