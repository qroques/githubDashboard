dev:
	docker-compose build
	docker-compose run --rm --no-deps php composer install
	docker-compose up -d
	@echo -e '\033[30;42mSUCCESS !\33[0m'
	@echo -e '\033[37;44mYour application is now runing ! Go to http://localhost/organization/{YOUR_ORGANIZATION} (e.g. \033[1;37;33mhttp://localhost/organization/knplabs)\33[0m'

start:
	docker-compose up -d

stop:
	docker-compose stop
